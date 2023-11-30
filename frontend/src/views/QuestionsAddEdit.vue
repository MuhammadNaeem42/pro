<template>
  <Layout>
	<PageHeader :title="title" :items="items" />
	<div class="row" v-if="!state.loading">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header align-items-center d-flex">
					<h4 class="card-title mb-0 flex-grow-1">Form</h4>
				</div><!-- end card header -->
				<div class="card-body">
					<div class="live-preview">
						<div class="row gy-4">
							<form @submit.prevent @submit="submitData">
								<div class="col-12">
									<div class="row">
										<div class="col-4">
											<label>Category</label>
											<select
												class="form-select mb-3"
												v-model="selected_category"
											>
												<option selected>Select</option>
												<option :value="category.id" v-for="(category) in categories" :key="category">{{category.name}}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">

									<div class="col-md-6">
										<div class="col-md-12">
											<div>
												<label for="exampleFormControlTextarea5" class="form-label">Kinywarwanda title</label>
												<textarea class="form-control" id="exampleFormControlTextarea5" rows="3" v-model="title_kin"></textarea>
											</div>
										</div><!--end col-->
									</div>

									<div class="col-md-6">
										<div class="col-md-12">
											<div>
												<label for="exampleFormControlTextarea5" class="form-label">English title</label>
												<textarea class="form-control" id="exampleFormControlTextarea5" v-model="title_en" rows="3"></textarea>
											</div>
										</div><!--end col-->
									</div>
								</div>
								<div class="row" v-for="(option, key) in options" :key="option">
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-2">
												<div class="form-check form-radio-primary mt-5">
													
													<label class="form-check-label">
														<input class="form-check-input" type="radio" name="correct_answer" :value="option.name" v-model="selected_option">
														Correct
													</label>
												</div>
											</div>
											<div class="col-md-10">
												<div class="mt-3">
													<label for="basiInput" class="form-label">Igisubizo {{option.name}}</label>
													<input type="text" class="form-control"  v-model="options[key].kin">
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="row">
										<div class="col-md-2">
										</div>
										<div class="col-md-10">
											<div class="mt-3">
												<label for="basiInput" class="form-label">Answer {{option.name}}</label>
												<input type="text" class="form-control" v-model="options[key].en">
											</div>
										</div>
									</div>
									</div>
								</div>
								<div class="row mt-3">

									<div class="col-md-6">
										<div class="col-md-12">
											<div>
												<label for="exampleFormControlTextarea5" class="form-label">Ubusobanuro bw'igisubizo </label>
												<textarea class="form-control" id="exampleFormControlTextarea5" rows="3" v-model="explanation_kin"></textarea>
											</div>
										</div><!--end col-->
									</div>

									<div class="col-md-6">
										<div class="col-md-12">
											<div>
												<label for="exampleFormControlTextarea5" class="form-label">Answer Explanation</label>
												<textarea class="form-control" id="exampleFormControlTextarea5" v-model="explanation_en" rows="3"></textarea>
											</div>
										</div><!--end col-->
									</div>
								</div>
								<div class="col-md-12 mt-3 d-flex">
									<div class="me-2">
										<button v-if="!state.submitting" class="btn btn-primary" type="submit">Submit</button>
										<button type="button" v-else class="btn btn-secondary">
											<div class="spinner-border" role="status">
												<span class="sr-only">Submiting...</span>
											</div>
										</button>
									</div>

									<div class="ms-3" v-if="mode=='edit'">
										<button v-if="!state.deleting" class="btn btn-danger" type="button" @click="deleteQuestion">Delete</button>
										<button type="button" v-else class="btn btn-secondary">
											<div class="spinner-border" role="status">
												<span class="sr-only">Deleting...</span>
											</div>
										</button>
									</div>
								</div>
							</form>
						</div><!--end row-->
					</div>
				</div>
			</div>
		</div><!--end col-->
	</div><!--end row-->
	</Layout>
</template>

<script>
import Layout from "../layouts/main.vue";
import PageHeader from "@/components/page-header";
import appConfig from "../../app.config";
import axios from 'axios';
// import router from '@/router';

export default {
	page: {
		title: "Add Question",
		meta: [{ name: "description", content: appConfig.description }],
	},
  	data() {
		return {
		title: "Add question",
		mode: "add",
		items: [
			{
			text: "Questions",
			href: "/questions",
			},
			{
			text: "Add",
			active: true,
			},
		],
		categories: [],
		name: null,
		title_kin: null,
		title_en: null,
		explanation_kin: null,
		explanation_en: null,
		selected_category: null,
		selected_option: null,
		editQuestionData: null,
		state: {
			loading: true,
			submitting: false,
			deleting: false,
		},
		options:[
			{
				name: 'A',
				en: '',
				kin: '',
				is_correct: false
			},
			{
				name: 'B',
				en: '',
				kin: '',
				is_correct: false
			},
			{
				name: 'C',
				en: '',
				kin: '',
				is_correct: false
			},
			{
				name: 'D',
				en: '',
				kin: '',
				is_correct: false
			},
			{
				name: 'E',
				en: '',
				kin: '',
				is_correct: false
			},
			{
				name: 'F',
				en: '',
				kin: '',
				is_correct: false
			},
		],
		};
  	},
	mounted() {
		// load questions
		this.state.loading = true
		axios.get('question-categories')
			.then(({data}) => {
				this.state.loading = false
				console.log(data)
				this.categories = data
			})
			.catch(() => {
				this.state.loading = false
			})

		let editQuestionId = this.$route.params?.question_id
		if(editQuestionId){
			this.mode = 'edit'

			// load the questin
			
			axios.get(`question/${editQuestionId}`)
				.then(({data}) => {
					console.log(data)
					this.editQuestionData = data
					this.title_kin = data.title
					this.title_en = data.title_en
					if(this.category){
						this.category.id = data.category
					}
					let qOptions = data.options

					this.options.forEach((option, optionKey) => {
						
						let serverOption  = qOptions[option.name]
						if(serverOption){
							console.log(qOptions[option.name], option.name)
							this.options[optionKey].id = qOptions[option.name].id
							this.options[optionKey].en = qOptions[option.name].title_en
							this.options[optionKey].kin = qOptions[option.name].title;

							if(option.name == data.answer.index){
								this.options[optionKey].is_correct = true
								this.selected_option = serverOption.index
								this.explanation_en = data.answer.explanation_en
								this.explanation_kin = data.answer.explanation
							}
						}
					})
				})  

		}
		console.log(editQuestionId)
	},
  	components: {
		Layout,
		PageHeader,
	},
	methods:{
		submitData(){
			if(this.state.submitting){
				alert("please wait for your submission or refresh")
			}

			this.state.submitting = true
			let reqData = {
				pseudoname: this.name,
				title_kin:this.title_kin,
				title_en: this.title_en,
				explanation_kin:this.explanation_kin,
				explanation_en: this.explanation_en,
				category: this.selected_category,
				options: this.options,
				correct_option: this.selected_option,
			}
			console.log(reqData, this.selected_category);

			if(this.mode == 'edit'){
				axios.put(`question/${this.editQuestionData.id}`, reqData)
				.then((data) => {
					console.log(data)
					alert("Question edited successfully")
					location.href = "/questions"
					this.state.submitting = false
				})
			}else{
				axios.post("question", reqData)
				.then((data) => {
					console.log(data)
					alert("Question added successfully")
					location.href = "/questions"
					this.state.submitting = false
				})
			}
			
		},
		deleteQuestion(){
			if(this.mode == 'edit' && confirm("Do you want to delete this question")){
				axios.delete(`question/${this.editQuestionData.id}`)
				.then((data) => {
					console.log(data)
					alert("Question deleted successfully")
					location.href = "/questions"
					this.state.deleting = false
				})
			}
		}
	},
};
</script>
