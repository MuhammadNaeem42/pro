<script>
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import Layout from "../../../layouts/main.vue";
import PageHeader from "@/components/page-header";
import appConfig from "../../../../app.config";

import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

export default {
  page: {
    title: "Customers",
    meta: [
      {
        name: "description",
        content: appConfig.description,
      },
    ],
  },
  data() {
    return {
      title: "Customers",
      items: [
        {
          text: "Ecommerce",
          href: "/",
        },
        {
          text: "Customers",
          active: true,
        },
      ],
      date1: null,
      date: null,
      rangeDateconfig: {
        mode: "range",
        dateFormat: "d M, Y",
      },
      searchQuery: null,
      defaultOptions: { animationData: animationData },
      defaultOptions2: { animationData: animationData1 },
      page: 1,
      perPage: 8,
      value: null,
      pages: [],
      customerList: [
        {
          id: 1,
          customerId: "#VZ2101",
          customer: "Mary Cousar",
          email: "marycousar@velzon.com",
          phone: "580-464-4694",
          date: "06 Apr, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 2,
          customerId: "#VZ2102",
          customer: "Jeff Taylor",
          email: "jefftaylor@velzon.com",
          phone: "863-577-5537",
          date: "15 Feb, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 3,
          customerId: "#VZ2103",
          customer: "Robert McMahon",
          email: "robertmcmahon@velzon.com",
          phone: "786-253-9927",
          date: "12 Jan, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 4,
          customerId: "#VZ2104",
          customer: "Michael Morris",
          email: "michaelmorris@velzon.com",
          phone: "805-447-8398",
          date: "19 May, 2021",
          status: "Block",
          statusClass: "danger",
        },
        {
          id: 5,
          customerId: "#VZ2105",
          customer: "Kevin Dawson",
          email: "kevindawson@velzon.com",
          phone: "213-741-4294",
          date: "14 Apr, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 6,
          customerId: "#VZ2106",
          customer: "Carolyn Jones",
          email: "carolynjones@velzon.com",
          phone: "414-453-5725",
          date: "07 Jun, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 7,
          customerId: "#VZ2107",
          customer: "Glen Matney",
          email: "glenmatney@velzon.com",
          phone: "515-395-1069",
          date: "02 Nov, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 8,
          customerId: "#VZ2108",
          customer: "Charles Kubik",
          email: "charleskubik@velzon.com",
          phone: "231-480-8536",
          date: "25 Sep, 2021",
          status: "Block",
          statusClass: "danger",
        },
        {
          id: 9,
          customerId: "#VZ2109",
          customer: "Herbert Stokes",
          email: "herbertstokes@velzon.com",
          phone: "312-944-1448",
          date: "20 Jul, 2021",
          status: "Block",
          statusClass: "danger",
        },
        {
          id: 10,
          customerId: "#VZ21010",
          customer: "Timothy Smith",
          email: "timothysmith@velzon.com",
          phone: "973-277-6950",
          date: "13 Dec, 2021",
          status: "Active",
          statusClass: "success",
        },
        {
          id: 11,
          customerId: "#VZ21011",
          customer: "Johnny Evans",
          email: "johnnyevans@velzon.com",
          phone: "407-645-1767",
          date: "01 Oct, 2021",
          status: "Block",
          statusClass: "danger",
        },
        {
          id: 12,
          customerId: "#VZ21012",
          customer: "Kevin Dawson",
          email: "kevindawson@velzon.com",
          phone: "213-741-4294",
          date: "14 Apr, 2021",
          status: "Active",
          statusClass: "success",
        },
      ],
    };
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.customerList);
    },
    resultQuery() {
      if (this.searchQuery) {
        const search = this.searchQuery.toLowerCase();
        return this.displayedPosts.filter((data) => {
          return (
            data.customer.toLowerCase().includes(search) ||
            data.email.toLowerCase().includes(search) ||
            data.phone.includes(search) ||
            data.date.toLowerCase().includes(search) ||
            data.status.toLowerCase().includes(search)
          );
        });
      } else {
        return this.displayedPosts;
      }
    },
  },
  watch: {
    customerList() {
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
      let numberOfPages = Math.ceil(this.customerList.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(customerList) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return customerList.slice(from, to);
    },
  },
  components: {
    Layout,
    PageHeader,
    lottie: Lottie,
    Multiselect,
    flatPickr,
  },
};
</script>

<template>
  <Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="customerList">
          <div class="card-header border-bottom-dashed">
            <div class="row g-4 align-items-center">
              <div class="col-sm">
                <div>
                  <h5 class="card-title mb-0">Customer List</h5>
                </div>
              </div>
              <div class="col-sm-auto">
                <div>
                  <button
                    type="button"
                    class="btn btn-success add-btn me-1"
                    data-bs-toggle="modal"
                    id="create-btn"
                    data-bs-target="#showModal"
                  >
                    <i class="ri-add-line align-bottom me-1"></i> Add Customer
                  </button>
                  <button type="button" class="btn btn-info">
                    <i class="ri-file-download-line align-bottom me-1"></i>
                    Import
                  </button>
                </div>
              </div>
            </div>
          </div>
          <div class="card-body border-bottom-dashed border-bottom">
            <form>
              <div class="row g-3">
                <div class="col-xl-6">
                  <div class="search-box">
                    <input
                      type="text"
                      class="form-control search"
                      placeholder="Search for customer, email, phone, status or something..."
                    />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </div>
                <!--end col-->
                <div class="col-xl-6">
                  <div class="row g-3">
                    <div class="col-sm-4">
                      <div class="">
                        <flat-pickr
                          v-model="date"
                          placeholder="Select date"
                          :config="rangeDateconfig"
                          class="form-control"
                        ></flat-pickr>
                      </div>
                    </div>
                    <!--end col-->
                    <div class="col-sm-4">
                      <div>
                        <Multiselect
                          class="form-control"
                          v-model="value"
                          :close-on-select="true"
                          :searchable="true"
                          :create-option="true"
                          :options="[
                            { value: '', label: 'Status' },
                            { value: 'All', label: 'All' },
                            { value: 'Active', label: 'Active' },
                            { value: 'Block', label: 'Block' },
                          ]"
                        />
                      </div>
                    </div>
                    <!--end col-->

                    <div class="col-sm-4">
                      <div>
                        <button
                          type="button"
                          class="btn btn-primary w-100"
                          onclick="SearchData();"
                        >
                          <i class="ri-equalizer-fill me-2 align-bottom"></i
                          >Filters
                        </button>
                      </div>
                    </div>
                    <!--end col-->
                  </div>
                </div>
              </div>
              <!--end row-->
            </form>
          </div>
          <div class="card-body">
            <div>
              <div class="table-responsive table-card mb-1">
                <table class="table align-middle" id="customerTable">
                  <thead class="table-light text-muted">
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

                      <th class="sort" data-sort="customer_name">Customer</th>
                      <th class="sort" data-sort="email">Email</th>
                      <th class="sort" data-sort="phone">Phone</th>
                      <th class="sort" data-sort="date">Joining Date</th>
                      <th class="sort" data-sort="status">Delivery Status</th>
                      <th class="sort" data-sort="action">Action</th>
                    </tr>
                  </thead>
                  <tbody class="list form-check-all">
                    <tr v-for="(item, index) of resultQuery" :key="index">
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
                          >{{ item.customerId }}</a
                        >
                      </td>
                      <td class="customer_name">{{ item.customer }}</td>
                      <td class="email">{{ item.email }}</td>
                      <td class="phone">{{ item.phone }}</td>
                      <td class="date">{{ item.date }}</td>
                      <td class="status">
                        <span
                          :class="`badge badge-soft-${item.statusClass} text-uppercase`"
                          >{{ item.status }}</span
                        >
                      </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li
                            class="list-inline-item edit"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Edit"
                          >
                            <a
                              href="#showModal"
                              data-bs-toggle="modal"
                              class="text-primary d-inline-block edit-item-btn"
                            >
                              <i class="ri-pencil-fill fs-16"></i>
                            </a>
                          </li>
                          <li
                            class="list-inline-item"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="Remove"
                          >
                            <a
                              class="text-danger d-inline-block remove-item-btn"
                              data-bs-toggle="modal"
                              data-bs-target="#deleteRecordModal"
                            >
                              <i class="ri-delete-bin-5-fill fs-16"></i>
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
                      We've searched more than 150+ customer We did not find any
                      customer for you search.
                    </p>
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
                  <ul
                    class="pagination listjs-pagination mb-0"
                    v-if="resultQuery.length >= 8"
                  >
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
            </div>
            <div
              class="modal fade"
              id="showModal"
              tabindex="-1"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button
                      type="button"
                      class="btn-close"
                      data-bs-dismiss="modal"
                      aria-label="Close"
                      id="close-modal"
                    ></button>
                  </div>
                  <form action="#">
                    <div class="modal-body">
                      <input type="hidden" id="id-field" />

                      <div class="mb-3" id="modal-id" style="display: none">
                        <label for="id-field1" class="form-label">ID</label>
                        <input
                          type="text"
                          id="id-field1"
                          class="form-control"
                          placeholder="ID"
                          readonly
                        />
                      </div>

                      <div class="mb-3">
                        <label for="customername-field" class="form-label"
                          >Customer Name</label
                        >
                        <input
                          type="text"
                          id="customername-field"
                          class="form-control"
                          placeholder="Enter Name"
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label for="email-field" class="form-label"
                          >Email</label
                        >
                        <input
                          type="email"
                          id="email-field"
                          class="form-control"
                          placeholder="Enter Email"
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label for="phone-field" class="form-label"
                          >Phone</label
                        >
                        <input
                          type="text"
                          id="phone-field"
                          class="form-control"
                          placeholder="Enter Phone no."
                          required
                        />
                      </div>

                      <div class="mb-3">
                        <label for="date-field" class="form-label"
                          >Joining Date</label
                        >
                        <flat-pickr
                          v-model="date1"
                          :config="config"
                          class="form-control"
                        ></flat-pickr>
                      </div>

                      <div>
                        <label for="status-field" class="form-label"
                          >Status</label
                        >
                        <select
                          class="form-control"
                          data-trigger
                          name="status-field"
                          id="status-field"
                        >
                          <option value="">Status</option>
                          <option value="Active">Active</option>
                          <option value="Block">Block</option>
                        </select>
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
                          Add Customer
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

            <!-- Modal -->
            <div
              class="modal fade zoomIn"
              id="deleteRecordModal"
              tabindex="-1"
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
                  <div class="modal-body">
                    <div class="mt-2 text-center">
                      <lottie
                        colors="primary:#f7b84b,secondary:#f06548"
                        :options="defaultOptions"
                        :height="100"
                        :width="100"
                      />
                      <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                        <h4>Are you sure ?</h4>
                        <p class="text-muted mx-4 mb-0">
                          Are you sure you want to remove this record ?
                        </p>
                      </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                      <button
                        type="button"
                        class="btn w-sm btn-light"
                        data-bs-dismiss="modal"
                      >
                        Close
                      </button>
                      <button
                        type="button"
                        class="btn w-sm btn-danger"
                        id="delete-record"
                      >
                        Yes, Delete It!
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end modal -->
          </div>
        </div>
      </div>
      <!--end col-->
    </div>
    <!--end row-->
  </Layout>
</template>
