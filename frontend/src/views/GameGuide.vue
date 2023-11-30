<template>
  <Layout>
	<PageHeader :title="title" :items="items" />

	<div class="row">
		<div class="col-xl-12">
			<div class="card">
				<div class="card-header align-items-center d-flex">
					<h4 class="card-title mb-0 flex-grow-1">Table</h4>
					<router-link to='/game_guide/add'>
						<button class="btn btn-primary">Add</button>
					</router-link>
				</div><!-- end card header -->  

				<div class="card-body">
					<div class="live-preview">
						<div class="table-responsive">
							<table class="table align-middle table-nowrap mb-0">
								<thead class="table-light">
									<tr>
										<th scope="col">#</th>
										<th scope="col">Kinyarwanda</th>
										<th scope="col">English</th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(question, key) in questions" :key="question">
										<td>{{key+1}}</td>
										<td>{{question.help_kin}}</td>
										<td>{{question.help_en}}</td>
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
	title: "Game guide",
	meta: [{ name: "description", content: appConfig.description }],
  },
  data() {
	return {
		title: "Game Guides",
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
		axios.get('help')
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
