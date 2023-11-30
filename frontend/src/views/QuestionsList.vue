<template>
  <Layout>
	<PageHeader :title="title" :items="items" />

	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header align-items-center d-flex">
					<h4 class="card-title mb-0 flex-grow-1">Table</h4>
					<router-link to='/questions-add-edit'>
						<button class="btn btn-primary">Add</button>
					</router-link>
				</div><!-- end card header -->  

				<div class="card-body">
					<div class="live-preview">
						<div class="table-responsive">
							<table class="table align-middle mb-0">
								<thead class="table-light">
									<tr>
										<th scope="col" style="width: 42px;">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="responsivetableCheck">
												<label class="form-check-label" for="responsivetableCheck"></label>
											</div>
										</th>
										<th scope="col">ID</th>
										<th scope="col">Question</th>
										<th scope="col">Category</th>
										<th scope="col">Answers</th>
										<th scope="col">Created</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(question, key) in questions" :key="question">
										<th scope="row">
											<div class="form-check">
												<input class="form-check-input" type="checkbox" value="" id="responsivetableCheck01">
												<label class="form-check-label" for="responsivetableCheck01"></label>
											</div>
										</th>
										<td>{{key+1}}</td>
										<td><router-link :to="{name: 'edit_question', params:{question_id:question.id}}" class="fw-medium">{{question.title}}</router-link></td>
										<td>{{question.category_name}}</td>
										<td>{{question.options.length}}</td>
										<td>{{question.created_at}}</td>
									</tr>
								</tbody>
							</table>
							<!-- end table -->
						</div>
						<!-- end table responsive -->
					</div>
				</div><!-- end card-body -->
			</div><!-- end card -->
		</div><!-- end col -->
	</div><!--end row-->
	</Layout>
</template>

<script>
import Layout from "../layouts/main.vue";
import PageHeader from "@/components/page-header";
import appConfig from "../../app.config";
import axios from 'axios';

import "prismjs";
import "prismjs/themes/prism.css";

export default {
  page: {
	title: "Questions",
	meta: [{ name: "description", content: appConfig.description }],
  },
  data() {
	return {
		title: "Questions List",
		questions: [],
		items: [],
	};
  },
	components: {
		Layout,
		PageHeader,
	},
	mounted() {
		// load questions
		axios.get('all_questions')
			.then(({data}) => {
				console.log(data)
				this.questions = data
			})    

	const checkbox = document.getElementsByClassName("code-switcher");
	Array.from(checkbox).forEach((check) => {
		check.addEventListener("change", () => {
		const card = check.closest(".card");
		const preview = card.querySelector(".live-preview");
		const code = card.querySelector(".code-view");
		if (check.checked) {
		  // do this
		  preview.classList.add("d-none");
		  code.classList.remove("d-none");
		} else {
		  // do that
		  preview.classList.remove("d-none");
		  code.classList.add("d-none");
		}
	  });
	});
  },
};
</script>
