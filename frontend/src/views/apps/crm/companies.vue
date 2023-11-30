<script>
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";

import Layout from "../../../layouts/main.vue";
import PageHeader from "@/components/page-header";
import appConfig from "../../../../app.config";

import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";

import animationData1 from "@/components/widgets/gsqxdxog.json";

export default {
  page: {
    title: "Companies",
    meta: [{ name: "description", content: appConfig.description }],
  },
  components: {
    Layout,
    PageHeader,
    lottie: Lottie,
    Multiselect,
  },
  data() {
    return {
      title: "Companies",
      items: [
        {
          text: "CRM",
          href: "/",
        },
        {
          text: "Companies",
          active: true,
        },
      ],
      value: null,
      page: 1,
      perPage: 8,
      pages: [],
      searchQuery: null,
      companies: [
        {
          id: 1,
          compnayId: "#VZ001",
          img: require("@/assets/images/brands/dribbble.png"),
          companyName: "Nesta Technologies",
          owner: "Tonya Noble",
          industryType: "Computer Industry",
          rating: "4.5",
          location: "Los Angeles, USA",
        },
        {
          id: 2,
          compnayId: "#VZ002",
          img: require("@/assets/images/brands/bitbucket.png"),
          companyName: "iTest Factory",
          owner: "Thomas Taylor",
          industryType: "Chemical Industries",
          rating: "3.8",
          location: "Berlin, Germany",
        },
        {
          id: 3,
          compnayId: "#VZ003",
          img: require("@/assets/images/companies/img-8.png"),
          companyName: "Force Medicines",
          owner: "Glen Matney",
          industryType: "Health Services",
          rating: "4.1",
          location: "Phoenix, USA",
        },
        {
          id: 4,
          compnayId: "#VZ004",
          img: require("@/assets/images/companies/img-1.png"),
          companyName: "Digitech Galaxy",
          owner: "Alexis Clarke",
          industryType: "Telecommunications Services",
          rating: "3.2",
          location: "Bogota, Colombia",
        },
        {
          id: 5,
          compnayId: "#VZ005",
          img: require("@/assets/images/companies/img-6.png"),
          companyName: "Zoetic Fashion",
          owner: "James Price",
          industryType: "Textiles: Clothing, Footwear",
          rating: "4.4",
          location: "Brasilia, Brazil",
        },
        {
          id: 6,
          compnayId: "#VZ006",
          img: require("@/assets/images/brands/dropbox.png"),
          companyName: "Micro Design",
          owner: "Mary Cousar",
          industryType: "Financial Services",
          rating: "2.7",
          location: "Windhoek, Namibia",
        },
        {
          id: 7,
          compnayId: "#VZ007",
          img: require("@/assets/images/brands/mail_chimp.png"),
          companyName: "Syntyce Solutions",
          owner: "Michael Morris",
          industryType: "Chemical Industries",
          rating: "4.0",
          location: "Damascus, Syria",
        },
        {
          id: 8,
          compnayId: "#VZ008",
          img: require("@/assets/images/companies/img-3.png"),
          companyName: "Meta4Systems",
          owner: "Nancy Martino",
          industryType: "Computer Industry",
          rating: "3.3",
          location: "London, UK",
        },
        {
          id: 9,
          compnayId: "#VZ009",
          img: require("@/assets/images/companies/img-4.png"),
          companyName: "Moetic Fashion",
          owner: "Timothy Smith",
          industryType: "Textiles: Clothing, Footwear",
          rating: "4.9",
          location: "Damascus, Syria",
        },
        {
          id: 10,
          compnayId: "#VZ0010",
          img: require("@/assets/images/brands/slack.png"),
          companyName: "Syntyce Solutions",
          owner: "Herbert Stokes",
          industryType: "Health Services",
          rating: "2.9",
          location: "Berlin, Germany",
        },
      ],
      defaultOptions: { animationData: animationData },
      defaultOptions1: { animationData: animationData1 },
    };
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.companies);
    },
    resultQuery() {
      if (this.searchQuery) {
        const search = this.searchQuery.toLowerCase();
        return this.displayedPosts.filter((data) => {
          return (
            data.compnayId.toLowerCase().includes(search) ||
            data.companyName.toLowerCase().includes(search) ||
            data.owner.toLowerCase().includes(search) ||
            data.industryType.toLowerCase().includes(search) ||
            data.rating.toLowerCase().includes(search) ||
            data.location.toLowerCase().includes(search)
          );
        });
      } else {
        return this.displayedPosts;
      }
    },
  },
  watch: {
    companies() {
      this.setPages();
    },
  },
  created() {
    this.setPages();
  },
  filters: {
    trimWords(value) {
      return value.split(" ").splice(0, 20).join(" ") + "...";
    },
  },
  methods: {
    setPages() {
      let numberOfPages = Math.ceil(this.companies.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(companies) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return companies.slice(from, to);
    },
  },
};
</script>

<template>
  <Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <div class="d-flex align-items-center flex-wrap gap-2">
              <div class="flex-grow-1">
                <button
                  class="btn btn-info add-btn"
                  data-bs-toggle="modal"
                  data-bs-target="#showModal"
                >
                  <i class="ri-add-fill me-1 align-bottom"></i> Add Company
                </button>
              </div>
              <div class="flex-shrink-0">
                <div class="hstack text-nowrap gap-2">
                  <button
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#addmembers"
                  >
                    <i class="ri-filter-2-line me-1 align-bottom"></i> Filters
                  </button>
                  <button class="btn btn-soft-info">Import</button>
                  <button
                    type="button"
                    id="dropdownMenuLink1"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                    class="btn btn-soft-primary"
                  >
                    <i class="ri-more-2-fill"></i>
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    <li><a class="dropdown-item" href="#">All</a></li>
                    <li><a class="dropdown-item" href="#">Last Week</a></li>
                    <li><a class="dropdown-item" href="#">Last Month</a></li>
                    <li><a class="dropdown-item" href="#">Last Year</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--end col-->
      <div class="col-xxl-9">
        <div class="card" id="companyList">
          <div class="card-header">
            <div class="row g-2">
              <div class="col-md-3">
                <div class="search-box">
                  <input
                    type="text"
                    class="form-control search"
                    placeholder="Search for company..."
                  />
                  <i class="ri-search-line search-icon"></i>
                </div>
              </div>
              <div class="col-md-auto ms-auto">
                <div class="d-flex align-items-center gap-2">
                  <span class="text-muted flex-shrink-0">Sort by: </span>

                  <Multiselect
                    class="form-control"
                    style="width:130px;"
                    v-model="value"
                    :close-on-select="true"
                    :searchable="true"
                    :create-option="true"
                    :options="[
                      { value: 'Owner', label: 'Owner' },
                      { value: 'Company', label: 'Company' },
                      { value: 'location', label: 'Location' },
                    ]"
                  />
                </div>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div>
              <div class="table-responsive table-card mb-3">
                <table
                  class="table align-middle table-nowrap mb-0"
                  id="customerTable"
                >
                  <thead class="table-light">
                    <tr>
                      <th scope="col" style="width: 50px">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="checkAll"
                            value="option"
                          />
                        </div>
                      </th>
                      <th class="sort" data-sort="name" scope="col">
                        Company Name
                      </th>
                      <th class="sort" data-sort="owner" scope="col">Owner</th>
                      <th class="sort" data-sort="industry_type" scope="col">
                        Industry Type
                      </th>
                      <th class="sort" data-sort="star_value" scope="col">
                        Rating
                      </th>
                      <th class="sort" data-sort="location" scope="col">
                        Location
                      </th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all">
                    <tr v-for="(data, index) of companies" :key="index">
                      <th scope="row">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            name="checkAll"
                            value="option1"
                          />
                        </div>
                      </th>
                      <td class="id" style="display: none">
                        <a
                          href="javascript:void(0);"
                          class="fw-medium link-primary"
                          >{{ data.id }}</a
                        >
                      </td>
                      <td>
                        <div class="d-flex align-items-center">
                          <div class="flex-shrink-0">
                            <img
                              :src="data.img"
                              alt=""
                              class="avatar-xxs rounded-circle"
                            />
                          </div>
                          <div class="flex-grow-1 ms-2 name">
                            {{ data.companyName }}
                          </div>
                        </div>
                      </td>
                      <td class="owner">{{ data.owner }}</td>
                      <td class="industry_type">{{ data.industryType }}</td>
                      <td>
                        <span class="star_value">{{ data.rating }}</span>
                        <i class="ri-star-fill text-warning align-bottom"></i>
                      </td>
                      <td class="location">{{ data.location }}</td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li
                            class="list-inline-item edit"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Call"
                          >
                            <a
                              href="javascript:void(0);"
                              class="text-muted d-inline-block"
                            >
                              <i class="ri-phone-line fs-16"></i>
                            </a>
                          </li>
                          <li
                            class="list-inline-item edit"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Message"
                          >
                            <a
                              href="javascript:void(0);"
                              class="text-muted d-inline-block"
                            >
                              <i class="ri-question-answer-line fs-16"></i>
                            </a>
                          </li>
                          <li
                            class="list-inline-item"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="View"
                          >
                            <a href="javascript:void(0);"
                              ><i
                                class="ri-eye-fill align-bottom text-muted"
                              ></i
                            ></a>
                          </li>
                          <li
                            class="list-inline-item"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Edit"
                          >
                            <a
                              class="edit-item-btn"
                              href="#showModal"
                              data-bs-toggle="modal"
                              ><i
                                class="ri-pencil-fill align-bottom text-muted"
                              ></i
                            ></a>
                          </li>
                          <li
                            class="list-inline-item"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Delete"
                          >
                            <a
                              class="remove-item-btn"
                              data-bs-toggle="modal"
                              href="#deleteRecordModal"
                            >
                              <i
                                class="ri-delete-bin-fill align-bottom text-muted"
                              ></i>
                            </a>
                          </li>
                        </ul>
                      </td>
                    </tr>
                  </tbody>
                </table>
                <div class="noresult" style="display: none">
                  <div class="text-center">
                    <lottie
                      class="avatar-xl"
                      colors="primary:#121331,secondary:#08a88a"
                      :options="defaultOptions"
                      :height="75"
                      :width="75"
                    />
                    <h5 class="mt-2">Sorry! No Result Found</h5>
                    <p class="text-muted mb-0">
                      We've searched more than 150+ Orders We did not find any
                      orders for you search.
                    </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
              <div class="pagination-wrap hstack gap-2">
                <a
                  class="page-item pagination-prev disabled"
                  href="#"
                  v-if="page != 1"
                  @click="page--"
                >
                  Previous
                </a>
                <ul class="pagination listjs-pagination mb-0">
                  <li
                     :class="{
                              active: pageNumber == page,
                              disabled: pageNumber == '...',
                            }"
                    v-for="(pageNumber, index) in pages.slice(
                      page - 1,
                      page + 5
                    )"
                    :key="index"
                    @click="page = pageNumber"
                  >
                    <a class="page" href="#">{{ pageNumber }}</a>
                  </li>
                </ul>
                <a
                  class="page-item pagination-next"
                  href="#"
                  @click="page++"
                  v-if="page < pages.length"
                >
                  Next
                </a>
              </div>
            </div>
            <div
              class="modal fade"
              id="showModal"
              tabindex="-1"
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                  <div class="modal-header bg-soft-info p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      id="close-modal"
                    ></button>
                  </div>
                  <form action="">
                    <div class="modal-body">
                      <input type="hidden" id="id-field" />
                      <div class="row g-3">
                        <div class="col-lg-12">
                          <div>
                            <label for="name-field" class="form-label"
                              >Name</label
                            >
                            <input
                              type="text"
                              id="customername-field"
                              class="form-control"
                              placeholder="Enter company name"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div>
                            <label for="owner-field" class="form-label"
                              >Owner Name</label
                            >
                            <input
                              type="text"
                              id="owner-field"
                              class="form-control"
                              placeholder="Enter owner name"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div>
                            <label for="industry_type-field" class="form-label"
                              >Industry Type</label
                            >
                            <select
                              class="form-control"
                              id="industry_type-field"
                            >
                              <option value="">Select industry type</option>
                              <option value="Computer Industry">
                                Computer Industry
                              </option>
                              <option value="Chemical Industries">
                                Chemical Industries
                              </option>
                              <option value="Health Services">
                                Health Services
                              </option>
                              <option value="Telecommunications Services">
                                Telecommunications Services
                              </option>
                              <option value="Textiles: Clothing, Footwear">
                                Textiles: Clothing, Footwear
                              </option>
                            </select>
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div>
                            <label for="star_value-field" class="form-label"
                              >Rating</label
                            >
                            <input
                              type="text"
                              id="star_value-field"
                              class="form-control"
                              placeholder="Enter rating"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div>
                            <label for="location-field" class="form-label"
                              >location</label
                            >
                            <input
                              type="text"
                              id="location-field"
                              class="form-control"
                              placeholder="Enter location"
                              required
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <div class="hstack gap-2 justify-content-end">
                        <button
                          type="button"
                          class="btn btn-light"
                          data-bs-dismiss="modal"
                        >
                          Close
                        </button>
                        <button
                          type="submit"
                          class="btn btn-success"
                          id="add-btn"
                        >
                          Add Company
                        </button>
                        <button
                          type="button"
                          class="btn btn-success"
                          id="edit-btn"
                        >
                          Update
                        </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!--end add modal-->

            <div
              class="modal fade zoomIn"
              id="deleteRecordModal"
              tabindex="-1"
              aria-labelledby="deleteRecordLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      id="btn-close"
                    ></button>
                  </div>
                  <div class="modal-body p-5 text-center">
                    <lottie
                      class="avatar-xl"
                      colors="primary:#405189,secondary:#f06548"
                      :options="defaultOptions1"
                      :height="90"
                      :width="90"
                    />
                    <div class="mt-4 text-center">
                      <h4 class="fs-semibold">
                        You are about to delete a company ?
                      </h4>
                      <p class="text-muted fs-14 mb-4 pt-1">
                        Deleting your company will remove all of your
                        information from our database.
                      </p>
                      <div class="hstack gap-2 justify-content-center remove">
                        <button
                          class="btn btn-link link-success fw-medium text-decoration-none"
                          data-bs-dismiss="modal"
                        >
                          <i class="ri-close-line me-1 align-middle"></i> Close
                        </button>
                        <button class="btn btn-danger" id="delete-record">
                          Yes, Delete It!!
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end delete modal -->
          </div>
        </div>
        <!--end card-->
      </div>
      <!--end col-->
      <div class="col-xxl-3">
        <div class="card">
          <div class="card-body text-center">
            <div class="position-relative d-inline-block">
              <div class="avatar-md">
                <div class="avatar-title bg-light rounded-circle">
                  <img
                    src="@/assets/images/brands/mail_chimp.png"
                    alt=""
                    class="avatar-xs"
                  />
                </div>
              </div>
            </div>
            <h5 class="mt-3 mb-1">Syntyce Solution</h5>
            <p class="text-muted">Michael Morris</p>

            <ul class="list-inline mb-0">
              <li class="list-inline-item avatar-xs">
                <a
                  href="javascript:void(0);"
                  class="avatar-title bg-soft-success text-success fs-15 rounded"
                >
                  <i class="ri-global-line"></i>
                </a>
              </li>
              <li class="list-inline-item avatar-xs">
                <a
                  href="javascript:void(0);"
                  class="avatar-title bg-soft-danger text-danger fs-15 rounded"
                >
                  <i class="ri-mail-line"></i>
                </a>
              </li>
              <li class="list-inline-item avatar-xs">
                <a
                  href="javascript:void(0);"
                  class="avatar-title bg-soft-warning text-warning fs-15 rounded"
                >
                  <i class="ri-question-answer-line"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <h6 class="text-muted text-uppercase fw-semibold mb-3">
              Information
            </h6>
            <p class="text-muted mb-4">
              A company incurs fixed and variable costs such as the purchase of
              raw materials, salaries and overhead, as explained by
              AccountingTools, Inc. Business owners have the discretion to
              determine the actions.
            </p>
            <div class="table-responsive table-card">
              <table class="table table-borderless mb-0">
                <tbody>
                  <tr>
                    <td class="fw-medium" scope="row">Industry Type</td>
                    <td>Chemical Industries</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Location</td>
                    <td>Damascus, Syria</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Employee</td>
                    <td>10-50</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Rating</td>
                    <td>
                      4.0 <i class="ri-star-fill text-warning align-bottom"></i>
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Website</td>
                    <td>
                      <a
                        href="javascript:void(0);"
                        class="link-primary text-decoration-underline"
                        >www.syntycesolution.com</a
                      >
                    </td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Contact Email</td>
                    <td>info@syntycesolution.com</td>
                  </tr>
                  <tr>
                    <td class="fw-medium" scope="row">Since</td>
                    <td>1995</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!--end card-->
      </div>
      <!--end col-->
    </div>
    <!--end row-->
  </Layout>
</template>
