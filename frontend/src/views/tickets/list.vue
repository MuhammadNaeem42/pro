<script>
import { CountTo } from "vue3-count-to";
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import Layout from "../../layouts/main.vue";
import PageHeader from "@/components/page-header";
import appConfig from "../../../app.config";

import Lottie from "@/components/widgets/lottie.vue";
import animationData from "@/components/widgets/msoeawqm.json";
import animationData1 from "@/components/widgets/gsqxdxog.json";

export default {
  page: {
    title: "List",
    meta: [{ name: "description", content: appConfig.description }],
  },
  data() {
    return {
      title: "List",
      items: [
        {
          text: "Tickets",
          href: "/",
        },
        {
          text: "List",
          active: true,
        },
      ],
      config: {
        wrap: true, // set wrap to true only when using 'input-group'
        altFormat: "M j, Y",
        altInput: true,
        dateFormat: "d M, Y",
      },
      date: null,
      date1: null,
      date2: null,
      searchQuery: null,
      page: 1,
      perPage: 9,
      pages: [],
      ticketsList: [
        {
          id: "#VLZ452",
          title: "Error message when placing an orders?",
          client: "Tonya Noble",
          assigned: "James Morris",
          create: "08 Dec, 2021",
          due: "25 Jan, 2022",
          status: "Inprogress",
          priority: "High",
        },
        {
          id: "#VLZ453",
          title: "Issue with finding information about order ?",
          client: "Mary Rucker",
          assigned: "David Nichols",
          create: "24 Oct, 2021",
          due: "20 Dec, 2021",
          status: "New",
          priority: "Low",
        },
        {
          id: "#VLZ454",
          title: "Apologize for shopping Error!",
          client: "Nathan Cole",
          assigned: "Nancy Martino",
          create: "17 Oct, 2021",
          due: "23 Oct, 2021",
          status: "Open",
          priority: "Medium",
        },
        {
          id: "#VLZ455",
          title: "Post launch reminder/ post list",
          client: "Joseph Parker",
          assigned: "Alexis Clarke",
          create: "03 Oct, 2021",
          due: "05 Oct, 2021",
          status: "Closed",
          priority: "High",
        },
        {
          id: "#VLZ456",
          title: "Make a creating an account profile",
          client: "Henry Baird",
          assigned: "David Nichols",
          create: "09 Oct, 2021",
          due: "17 Oct, 2021",
          status: "Inprogress",
          priority: "Medium",
        },
        {
          id: "#VLZ457",
          title: "Change email option process",
          client: "Tonya Noble",
          assigned: "Nancy Martino",
          create: "27 Oct, 2021",
          due: "04 Dec, 2021",
          status: "Open",
          priority: "High",
        },
        {
          id: "#VLZ458",
          title: "User research",
          client: "Donald Palmer",
          assigned: "James Morris",
          create: "05 Oct, 2021",
          due: "11 Oct, 2021",
          status: "New",
          priority: "Low",
        },
        {
          id: "#VLZ459",
          title: "Banner design for FB & Twitter",
          client: "Mary Rucker",
          assigned: "Jennifer Carter",
          create: "09 Dec, 2021",
          due: "16 Dec, 2021",
          status: "Closed",
          priority: "Medium",
        },
        {
          id: "#VLZ460",
          title: "Brand logo design",
          client: "Tonya Noble",
          assigned: "Alexis Clarke",
          create: "24 Dec, 2021",
          due: "29 Dec, 2021",
          status: "Closed",
          priority: "High",
        },
        {
          id: "#VLZ461",
          title: "Additional Calendar",
          client: "Diana Kohler",
          assigned: "David Nichols",
          create: "04 Oct, 2021",
          due: "13 Oct, 2021",
          status: "New",
          priority: "Low",
        },
        {
          id: "#VLZ462",
          title: "Edit customer testimonial",
          client: "Nathan Cole",
          assigned: "Nancy Martino",
          create: "21 Dec, 2021",
          due: "02 Jan, 2021",
          status: "Inprogress",
          priority: "Medium",
        },
      ],
      defaultOptions: { animationData: animationData },
      defaultOptions1: { animationData: animationData1 },
    };
  },
  components: {
    Layout,
    PageHeader,
    CountTo,
    lottie: Lottie,
    Multiselect,
    flatPickr,
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.ticketsList);
    },
    resultQuery() {
      if (this.searchQuery) {
        const search = this.searchQuery.toLowerCase();
        return this.displayedPosts.filter((data) => {
          return (
            data.title.toLowerCase().includes(search) ||
            data.client.toLowerCase().includes(search) ||
            data.assigned.toLowerCase().includes(search) ||
            data.create.toLowerCase().includes(search) ||
            data.due.toLowerCase().includes(search) ||
            data.status.toLowerCase().includes(search) ||
            data.priority.toLowerCase().includes(search)
          );
        });
      } else {
        return this.displayedPosts;
      }
    },
  },
  watch: {
    posts() {
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
      let numberOfPages = Math.ceil(this.ticketsList.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(ticketsList) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return ticketsList.slice(from, to);
    },
  },
};
</script>

<template>
  <Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
      <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-semibold text-muted mb-0">Total Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to
                    :duration="1000"
                    :startVal="0"
                    :endVal="547"
                  ></count-to
                  >k
                </h2>
                <p class="mb-0 text-muted">
                  <span class="badge bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 17.32 %
                  </span>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span
                    class="avatar-title bg-soft-info text-info rounded-circle fs-4"
                  >
                    <i class="ri-ticket-2-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- end card body -->
        </div>
        <!-- end card-->
      </div>
      <!--end col-->
      <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-semibold text-muted mb-0">Pending Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to
                    :duration="1000"
                    :startVal="0"
                    :endVal="124"
                  ></count-to
                  >k
                </h2>
                <p class="mb-0 text-muted">
                  <span class="badge bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 0.96 %
                  </span>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span
                    class="avatar-title bg-soft-primary text-primary rounded-circle fs-4"
                  >
                    <i class="mdi mdi-timer-sand"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- end card body -->
        </div>
      </div>
      <!--end col-->
      <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-semibold text-muted mb-0">Closed Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to
                    :duration="1000"
                    :startVal="0"
                    :endVal="107"
                  ></count-to
                  >K
                </h2>
                <p class="mb-0 text-muted">
                  <span class="badge bg-light text-danger mb-0">
                    <i class="ri-arrow-down-line align-middle"></i> 3.87 %
                  </span>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span
                    class="avatar-title bg-soft-info text-info rounded-circle fs-4"
                  >
                    <i class="ri-shopping-bag-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- end card body -->
        </div>
      </div>
      <!--end col-->
      <div class="col-xxl-3 col-sm-6">
        <div class="card card-animate">
          <div class="card-body">
            <div class="d-flex justify-content-between">
              <div>
                <p class="fw-semibold text-muted mb-0">Deleted Tickets</p>
                <h2 class="mt-4 ff-secondary fw-semibold">
                  <count-to
                    :duration="1000"
                    :startVal="0"
                    :endVal="15"
                  ></count-to
                  >%
                </h2>
                <p class="mb-0 text-muted">
                  <span class="badge bg-light text-success mb-0">
                    <i class="ri-arrow-up-line align-middle"></i> 1.09 %
                  </span>
                  vs. previous month
                </p>
              </div>
              <div>
                <div class="avatar-sm flex-shrink-0">
                  <span
                    class="avatar-title bg-soft-primary text-primary rounded-circle fs-4"
                  >
                    <i class="ri-delete-bin-line"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <!-- end card body -->
        </div>
      </div>
      <!--end col-->
    </div>
    <!--end row-->

    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="ticketsList">
          <div class="card-header border-0">
            <div class="d-flex align-items-center">
              <h5 class="card-title mb-0 flex-grow-1">Tickets</h5>
              <div class="flex-shrink-0">
                <button
                  class="btn btn-primary add-btn"
                  data-bs-toggle="modal"
                  data-bs-target="#showModal"
                >
                  <i class="ri-add-line align-bottom me-1"></i> Create Tickets
                </button>
              </div>
            </div>
          </div>
          <div
            class="card-body border border-dashed border-end-0 border-start-0"
          >
            <form>
              <div class="row g-3">
                <div class="col-xxl-5 col-sm-12">
                  <div class="search-box">
                    <input
                      type="text"
                      class="form-control search bg-light border-light"
                      placeholder="Search for ticket details or something..."
                    />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </div>
                <!--end col-->

                <div class="col-xxl-3 col-sm-4">
                  <flat-pickr
                    v-model="date"
                    :config="config"
                    class="form-control bg-light border-light"
                  ></flat-pickr>
                </div>
                <!--end col-->

                <div class="col-xxl-3 col-sm-4">
                  <div class="input-light">
                    <Multiselect
                      v-model="value3"
                      :close-on-select="true"
                      :searchable="true"
                      :create-option="true"
                      :options="[
                        { value: '', label: 'Status' },
                        { value: 'All', label: 'All' },
                        { value: 'Open', label: 'Open' },
                        { value: 'Inprogress', label: 'Inprogress' },
                        { value: 'Closed', label: 'Closed' },
                        { value: 'New', label: 'New' },
                      ]"
                    />
                  </div>
                </div>
                <!--end col-->
                <div class="col-xxl-1 col-sm-4">
                  <button
                    type="button"
                    class="btn btn-info w-100"
                    onclick="SearchData();"
                  >
                    <i class="ri-equalizer-fill me-1 align-bottom"></i>
                    Filters
                  </button>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </form>
          </div>
          <!--end card-body-->
          <div class="card-body">
            <div class="table-responsive table-card mb-4">
              <table
                class="table align-middle table-nowrap mb-0"
                id="ticketTable"
              >
                <thead>
                  <tr>
                    <th scope="col" style="width: 40px">
                      <div class="form-check">
                        <input
                          class="form-check-input"
                          type="checkbox"
                          id="checkAll"
                          value="option"
                        />
                      </div>
                    </th>
                    <th class="sort" data-sort="id">ID</th>
                    <th class="sort" data-sort="tasks_name">Title</th>
                    <th class="sort" data-sort="client_name">Client</th>
                    <th class="sort" data-sort="assignedto">Assigned To</th>
                    <th class="sort" data-sort="create_date">Create Date</th>
                    <th class="sort" data-sort="due_date">Due Date</th>
                    <th class="sort" data-sort="status">Status</th>
                    <th class="sort" data-sort="priority">Priority</th>
                    <th class="sort" data-sort="action">Action</th>
                  </tr>
                </thead>
                <tbody class="list form-check-all">
                  <tr v-for="(data, index) of resultQuery" :key="index">
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
                    <td class="id">
                      <router-link
                        to="/apps/tickets-details"
                        class="fw-semibold link-primary"
                        >{{ data.id }}</router-link
                      >
                    </td>
                    <td class="tasks_name">
                      {{ data.title }}
                    </td>
                    <td class="client_name">{{ data.client }}</td>
                    <td class="assignedto">{{ data.assigned }}</td>
                    <td class="create_date">{{ data.create }}</td>
                    <td class="due_date">{{ data.due }}</td>
                    <td class="status">
                      <span
                        class="badge text-uppercase"
                        :class="{
                          'badge-soft-warning': data.status == 'Inprogress',
                          'badge-soft-info': data.status == 'New',
                          'badge-soft-success': data.status == 'Open',
                          'badge-soft-danger': data.status == 'Closed',
                        }"
                        >{{ data.status }}</span
                      >
                    </td>
                    <td class="priority">
                      <span
                        class="badge text-uppercase"
                        :class="{
                          'bg-danger': data.priority == 'High',
                          'bg-success': data.priority == 'Low',
                          'bg-warning': data.priority == 'Medium',
                        }"
                        >{{ data.priority }}</span
                      >
                    </td>
                    <td>
                      <div class="dropdown">
                        <button
                          class="btn btn-soft-secondary btn-sm dropdown"
                          type="button"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                          <li>
                            <router-link
                              class="dropdown-item"
                              to="/apps/tickets-details"
                              ><i
                                class="ri-eye-fill align-bottom me-2 text-muted"
                              ></i>
                              View</router-link
                            >
                          </li>
                          <li>
                            <a
                              class="dropdown-item edit-item-btn"
                              href="#showModal"
                              data-bs-toggle="modal"
                              ><i
                                class="ri-pencil-fill align-bottom me-2 text-muted"
                              ></i>
                              Edit</a
                            >
                          </li>
                          <li>
                            <a
                              class="dropdown-item remove-item-btn"
                              data-bs-toggle="modal"
                              href="#deleteOrder"
                            >
                              <i
                                class="ri-delete-bin-fill align-bottom me-2 text-muted"
                              ></i>
                              Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div
                class="noresult"
                style="display: none"
                :class="{ 'd-block': resultQuery.length == 0 }"
              >
                <div class="text-center">
                  <lottie
                    class="avatar-xl"
                    colors="primary:#121331,secondary:#08a88a"
                    :options="defaultOptions"
                    :height="90"
                    :width="90"
                  />
                  <h5 class="mt-2">Sorry! No Result Found</h5>
                  <p class="text-muted mb-0">
                    We've searched more than 150+ Tickets We did not find any
                    Tickets for you search.
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

            <!-- Modal -->
            <div
              class="modal fade flip"
              id="deleteOrder"
              tabindex="-1"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-body p-5 text-center">
                    <lottie
                      class="avatar-xl"
                      colors="primary:#405189,secondary:#f06548"
                      :options="defaultOptions1"
                      :height="90"
                      :width="90"
                    />
                    <div class="mt-4 text-center">
                      <h4>You are about to delete a order ?</h4>
                      <p class="text-muted fs-14 mb-4">
                        Deleting your order will remove all of your information
                        from our database.
                      </p>
                      <div class="hstack gap-2 justify-content-center remove">
                        <button
                          class="btn btn-link link-success fw-semibold text-decoration-none"
                          data-bs-dismiss="modal"
                        >
                          <i class="ri-close-line me-1 align-middle"></i> Close
                        </button>
                        <button class="btn btn-danger" id="delete-record">
                          Yes, Delete It
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--end modal -->
          </div>
          <!--end card-body-->
        </div>
        <!--end card-->
      </div>
      <!--end col-->
    </div>
    <!--end row-->

    <div
      class="modal fade zoomIn"
      id="showModal"
      tabindex="-1"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
          <div class="modal-header p-3 bg-soft-info">
            <h5 class="modal-title" id="exampleModalLabel"></h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
              aria-label="Close"
              id="close-modal"
            ></button>
          </div>
          <form>
            <div class="modal-body">
              <div class="row g-3">
                <div class="col-lg-12">
                  <div id="modal-id">
                    <label for="orderId" class="form-label">ID</label>
                    <input
                      type="text"
                      id="orderId"
                      class="form-control"
                      placeholder="ID"
                      value="#VLZ462"
                      readonly
                    />
                  </div>
                </div>
                <div class="col-lg-12">
                  <div>
                    <label for="tasksTitle-field" class="form-label"
                      >Title</label
                    >
                    <input
                      type="text"
                      id="tasksTitle-field"
                      class="form-control"
                      placeholder="Title"
                      required
                    />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div>
                    <label for="clientName-field" class="form-label"
                      >Client</label
                    >
                    <input
                      type="text"
                      id="clientName-field"
                      class="form-control"
                      placeholder="Client Name"
                      required
                    />
                  </div>
                </div>
                <div class="col-lg-6">
                  <div>
                    <label for="assignedtoName-field" class="form-label"
                      >Assigned To</label
                    >
                    <input
                      type="text"
                      id="assignedtoName-field"
                      class="form-control"
                      placeholder="Assigned to"
                      required
                    />
                  </div>
                </div>
                <div class="col-lg-6">
                  <label for="date-field" class="form-label">Create Date</label>

                  <flat-pickr
                    v-model="date1"
                    :config="config"
                    class="form-control bg-light border-light"
                  ></flat-pickr>
                </div>
                <div class="col-lg-6">
                  <label for="duedate-field" class="form-label">Due Date</label>

                  <flat-pickr
                    v-model="date2"
                    :config="config"
                    class="form-control bg-light border-light"
                  ></flat-pickr>
                </div>
                <div class="col-lg-6">
                  <label for="ticket-status" class="form-label">Status</label>
                  <select
                    class="form-control"
                    data-plugin="choices"
                    name="ticket-status"
                    id="ticket-status"
                  >
                    <option value="">Status</option>
                    <option value="New">New</option>
                    <option value="Inprogress">Inprogress</option>
                    <option value="Closed">Closed</option>
                    <option value="Open">Open</option>
                  </select>
                </div>
                <div class="col-lg-6">
                  <label for="priority-field" class="form-label"
                    >Priority</label
                  >
                  <select
                    class="form-control"
                    data-plugin="choices"
                    name="priority-field"
                    id="priority-field"
                  >
                    <option value="">Priority</option>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                  </select>
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
                <button type="submit" class="btn btn-success" id="add-btn">
                  Add Ticket
                </button>
                <button type="button" class="btn btn-success" id="edit-btn">
                  Update
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </Layout>
</template>
