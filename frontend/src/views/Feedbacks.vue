<template>
  <Layout>
	<PageHeader :title="title" :items="items" />

	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header align-items-center d-flex">
					<h4 class="card-title mb-0 flex-grow-1">Table</h4>
				</div><!-- end card header -->  

				<div class="card-body">
					<div class="live-preview">
						<div class="table-responsive">
							<table class="table align-middle table-nowrap mb-0">
								<thead class="table-light">
									<tr>
										<th scope="col">ID</th>
										<th scope="col">Feedback</th>
										<th scope="col">Given time</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(question, key) in questions" :key="question">
										<td>{{key+1}}</td>
										<td><a href="#" class="fw-medium">{{question.feedback}}</a></td>
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
	title: "Feedbacks",
	meta: [{ name: "description", content: appConfig.description }],
  },
  data() {
	return {
		title: "Feedback List",
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
		axios.get('feedback')
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
