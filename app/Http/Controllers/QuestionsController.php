<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Models\Question;
use App\Models\QuestionAnswerOption;
use App\Models\QuestionCategory;
use App\Models\Answer;

class QuestionsController extends Controller
{
	//

	public function listAll(Request $request)
	{
		$questions = Question::leftJoin("question_categories", "questions.category", "question_categories.id")
					->selectRaw("questions.*, question_categories.name as category_name, question_categories.color_code")
					->orderByDesc("questions.id")
					->get();

		foreach($questions as $key=>$question){
			$options = QuestionAnswerOption::where("question", $question->id)->get();
			$answerTemp = Answer::join("question_answer_options", "answers.question_option", "question_answer_options.id")
				
				->where("question_answer_options.question", $question->id)
				->selectRaw("question_answer_options.index, answers.explanation, answers.explanation_en")->get()->first();
			$questions[$key]->index = $key;
			$questions[$key]->options = $options;
			$questions[$key]->answer = $answerTemp;
		}
		return $questions;
	}

	public function listGameQuestion(Request $request)
	{
		$categories = QuestionCategory::all();
		$socialQuestions = Question::where('category', null)->orderBy(DB::raw('RAND()'));
		$pickedSocials = [];

		// Select questions category by category
		$catQuestions = [];
		foreach ($categories as $catKey => $category) {
			// Get 6 questions in category
			$categoryQuestions = Question::where('category', $category->id)
								->orderBy(DB::raw('RAND()'))->limit(6)->get();
			if(!isset($catQuestions[$category->id])) $catQuestions[$category->id] = [];

			$socialCatQuestions = $socialQuestions->limit(4)->whereNotIn("id", $pickedSocials)->get();

			// Append this list to already picked social questions to avoid duplicates
			$tempPickedIds = $socialCatQuestions->map(function($question){
				return $question->id;
			})->toArray();
			$pickedSocials = array_merge($pickedSocials, $tempPickedIds);

			$categoryQuestions = $categoryQuestions->concat($socialCatQuestions);

			// If question does not count to 20, then add more health questions
			if($categoryQuestions->count() < 10){
				$missingCount = 10 - $categoryQuestions->count();
				$categoryQuestions = $categoryQuestions->concat(Question::where('category', $category->id)
										->limit($missingCount)->get());	
			}

			foreach ($categoryQuestions as $catQuestionKey => $question) {
				$question->category_name = $category->name;
				$question->index = $catQuestionKey+1;
				$question->category_name_en = $category->name_en;
				$question->color_code = $category->color_code;

				$options = QuestionAnswerOption::where("question", $question->id)->get();
				$answerTemp = Answer::join("question_answer_options", "answers.question_option", "question_answer_options.id")
					->where("question_answer_options.question", $question->id)
					->selectRaw("question_answer_options.index, answers.explanation, answers.explanation_en")
					->get()->first();

				$question->options = $options;
				$question->answer = $answerTemp;

				$catQuestions[$category->id][] = $question;
			}
		}

		$returnQuestions = [];

		foreach($catQuestions as $catQ){
			$returnQuestions = array_merge($returnQuestions, $catQ);
		}
		return $returnQuestions;
	}

	public function show($id)
	{
		$question = Question::findOrFail($id);

		// $question->category_name = $category->name;
		// $question->index = $catQuestionKey+1;
		// $question->category_name_en = $category->name_en;
		// $question->color_code = $category->color_code;

		$options = QuestionAnswerOption::where("question", $question->id)->get();
		$answerTemp = Answer::join("question_answer_options", "answers.question_option", "question_answer_options.id")
		->where("question_answer_options.question", $question->id)
		->selectRaw("question_answer_options.index, answers.explanation, answers.explanation_en")
		->get()->first();

		$structureOptions = [];
		foreach($options as $option){
			$structureOptions[$option->index] = $option;
		}
		$question->options = $structureOptions;
		$question->answer = $answerTemp;

		return $question;
	}

	public function addNew(Request $request){
		$title = $request->input("title_kin");
		$title_en = $request->input("title_en");
		$category = $request->input("category");
		$explanation = $request->input("explanation_kin");
		$explanation_en = $request->input("explanation_en");
		$correct_option = $request->input("correct_option");

		$question = new Question();
		$question->title = $title;
		$question->title_en = $title_en;
		$question->category = $category;
		$question->save();


		$answerOptions = $request->input("options");
		// var_dump($answerOptions);
		// die();

		$correctOption = null;
		foreach ($answerOptions as $key => $option) {
			$option = (object)$option;
			if(empty($option->kin) || empty($option->en)){
				continue;
			}
			$answerOption = new QuestionAnswerOption();
			$answerOption->index = $option->name;
			$answerOption->title = $option->kin;
			$answerOption->title_en = $option->en;
			$answerOption->question = $question->id;
			$answerOption->save();

			if($option->name == $correct_option){
				$correctOption = $answerOption;
			}
		}

		// Create correct answer
		$answer = new Answer();
		$answer->question_option = $correctOption->id;
		$answer->explanation = $explanation;
		$answer->explanation_en = $explanation_en;
		$answer->save();
		return $question;
	}

	public function update($questionId, Request $request){
		$title = $request->input("title_kin");
		$title_en = $request->input("title_en");
		$category = $request->input("category");
		$explanation = $request->input("explanation_kin");
		$explanation_en = $request->input("explanation_en");
		$correct_option = $request->input("correct_option");

		$question = Question::findOrFail($questionId);
		$question->title = $title;
		$question->title_en = $title_en;
		$question->category = $category;
		$question->save();


		$answerOptions = $request->input("options");

		$answer = Answer::join('question_answer_options', "question_answer_options.id", "answers.question_option")
					->where("question_answer_options.question", $questionId)
					->select("answers.*")
					->first();
		$newAnswer = null;
		foreach ($answerOptions as $key => $option) {
			$option = (object)$option;
			if(empty($option->kin) || empty($option->en)){
				// this option should be deleted

				$deleteOption = QuestionAnswerOption::where([
					'question' => $question->id,
					'index' => $option->name,
				])->first();
				if($deleteOption){
					$deleteOption->delete();
				}

				continue;
			}

			if(!empty($option->id)){
				$answerOption = QuestionAnswerOption::findOrFail($option->id);
			}else{
				// Create the option
				$answerOption = new QuestionAnswerOption();
			}
			
			$answerOption->index = $option->name;
			$answerOption->title = $option->kin;
			$answerOption->title_en = $option->en;
			$answerOption->question = $question->id;
			$answerOption->save();

			if($option->name == $correct_option ){
				$newAnswer = $answerOption;
			}
		}

		// Create correct answer
		$answer->question_option = $newAnswer->id;
		$answer->explanation = $explanation;
		$answer->explanation_en = $explanation_en;
		$answer->save();
		return $question;
	}

	public function destroy($questionId){

		$question = Question::findOrFail($questionId);
		$question->delete();


		$answerOptions = QuestionAnswerOption::where('question', $questionId);

		$answer = Answer::join('question_answer_options', "question_answer_options.id", "answers.question_option")
					->where("question_answer_options.question", $questionId)
					->first();
		foreach ($answerOptions as $key => $option) {
			$option->delete();
		}
		$answer->delete();
		
		return $question;
	}



	public function listCategories(Request $request)
	{
		$categories = QuestionCategory::all();
		return $categories;
	}
}
