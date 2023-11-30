<template>
  <Layout>
	<PageHeader :title="title" :items="items" />
	<div class="row">
		<div class="col-lg-12">
			<div class="card">
				<div class="card-header align-items-center d-flex">
					<h4 class="card-title mb-0 flex-grow-1">Form</h4>
				</div><!-- end card header -->
				<div class="card-body">
					<div class="live-preview">
						<div class="row gy-4">
							<form @submit.prevent @submit="submitData">
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
								<div class="col-md-12 mt-3">
									<button class="btn btn-primary" type="submit">Submit</button>
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
import router from '@/router';

export default {
	page: {
		title: "Add Guide",
		meta: [{ name: "description", content: appConfig.description }],
	},
  	data() {
		return {
		title: "Add guide",
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
		};
  	},
	mounted() {
		// load questions
		axios.get('question-categories')
			.then(({data}) => {
				console.log(data)
				this.categories = data
			})  
	},
  	components: {
		Layout,
		PageHeader,
	},
	methods:{
		submitData(){
			
			let reqData = {
				title_kin:this.title_kin,
				title_en: this.title_en,
			}
			console.log(reqData);
			axios.post("help", reqData)
			.then((data) => {
				console.log(data)
				alert("Guide added successfully")
				router.go("/game_guide")
			})

			
		}
	},
};
</script>
