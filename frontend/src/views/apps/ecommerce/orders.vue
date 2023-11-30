<script>
import Multiselect from "@vueform/multiselect";
import "@vueform/multiselect/themes/default.css";
import flatPickr from "vue-flatpickr-component";
import "flatpickr/dist/flatpickr.css";

import Layout from "../../../layouts/main.vue";
import appConfig from "../../../../app.config";
import PageHeader from "@/components/page-header";

import animationData from "@/components/widgets/msoeawqm.json";
import Lottie from "@/components/widgets/lottie.vue";

export default {
  page: {
    title: "Orders",
    meta: [
      {
        name: "description",
        content: appConfig.description,
      },
    ],
  },
  data() {
    return {
      title: "Orders",
      items: [
        {
          text: "Ecommerce",
          href: "/",
        },
        {
          text: "Orders",
          active: true,
        },
      ],
      page: 1,
      perPage: 8,
      pages: [],
      value: null,
      value1: null,
      searchQuery: null,
      config: {
        wrap: true, // set wrap to true only when using 'input-group'
        altFormat: "M j, Y",
        altInput: true,
        dateFormat: "d M, Y",
        mode: "range",
      },
      timeConfig: {
        wrap: true, // set wrap to true only when using 'input-group'
        altFormat: "M j, Y",
        altInput: true,
        dateFormat: "d M, Y",
        enableTime: true,
        noCalendar: true,
      },
      date: null,
      date2: null,
      defaultOptions: { animationData: animationData },
      orders: [
        {
          id: 1,
          orderId: "#VZ2101",
          customer: "Frank Hook",
          product: "Puma Tshirt",
          orderDate: "20 Dec, 2021",
          amount: "$654",
          payment: "Mastercard",
          status: "Pending",
          statusClass: "warning",
        },
        {
          id: 2,
          orderId: "#VZ2102",
          customer: "Rickey Teran",
          product: "Adidas Sneakers",
          orderDate: "16 Dec, 2021",
          amount: "$354",
          payment: "Paypal",
          status: "Cancelled",
          statusClass: "danger",
        },
        {
          id: 3,
          orderId: "#VZ2103",
          customer: "James Price",
          product: "350 ml Glass Grocery Container",
          orderDate: "28 Nov, 2021",
          amount: "$829",
          payment: "Visa",
          status: "Inprogress",
          statusClass: "secondary",
        },
        {
          id: 4,
          orderId: "#VZ2104",
          customer: "Nettie Deloatch",
          product: "American egale outfitters Shirt",
          orderDate: "22 Nov, 2021",
          amount: "$142",
          payment: "COD",
          status: "Pending",
          statusClass: "warning",
        },
        {
          id: 5,
          orderId: "#VZ2105",
          customer: "Thomas Taylor",
          product: "Galaxy Watch4",
          orderDate: "12 Nov, 2021",
          amount: "$408",
          payment: "Mastercard",
          status: "Pickups",
          statusClass: "info",
        },
        {
          id: 6,
          orderId: "#VZ2106",
          customer: "James Price",
          product: "Apple iPhone 12",
          orderDate: "05 Nov, 2021",
          amount: "$1240",
          payment: "Visa",
          status: "Inprogress",
          statusClass: "secondary",
        },
        {
          id: 7,
          orderId: "#VZ2107",
          customer: "Nancy Martino",
          product: "Funky Prints T-shirt",
          orderDate: "31 Oct, 2021",
          amount: "$180",
          payment: "COD",
          status: "Returns",
          statusClass: "primary",
        },
        {
          id: 8,
          orderId: "#VZ2108",
          customer: "Alexis Clarke",
          product: "USB Flash Drive Personalized with 3D Print",
          orderDate: "25 Oct, 2021",
          amount: "$247",
          payment: "Paypal",
          status: "Delivered",
          statusClass: "success",
        },
        {
          id: 9,
          orderId: "#VZ2109",
          customer: "Donald Palmer",
          product: "Oxford Button-Down Shirt",
          orderDate: "19 Oct, 2021",
          amount: "$373",
          payment: "Visa",
          status: "Pickups",
          statusClass: "info",
        },
        {
          id: 10,
          orderId: "#VZ2110",
          customer: "Henry Baird",
          product: "Classic Short Sleeve Shirt",
          orderDate: "13 Oct, 2021",
          amount: "$342",
          payment: "Mastercard",
          status: "Inprogress",
          statusClass: "secondary",
        },
        {
          id: 11,
          orderId: "#VZ2111",
          customer: "Diana Kohler",
          product: "Half Sleeve T-Shirts (Blue)",
          orderDate: "01 Oct, 2021",
          amount: "$874",
          payment: "Visa",
          status: "Delivered",
          statusClass: "success",
        },
        {
          id: 12,
          orderId: "#VZ2112",
          customer: "Alexis Clarke",
          product: "Noise Evolve Smartwatch",
          orderDate: "29 Sep, 2021",
          amount: "$1021",
          payment: "Mastercard",
          status: "Cancelled",
          statusClass: "danger",
        },
      ],
      isStatus: null,
      isPayment: null,
    };
  },
  components: {
    Layout,
    PageHeader,
    lottie: Lottie,
    Multiselect,
    flatPickr,
  },
  computed: {
    displayedPosts() {
      return this.paginate(this.orders);
    },
    resultQuery() {
      if (this.searchQuery) {
        const search = this.searchQuery.toLowerCase();
        return this.displayedPosts.filter((data) => {
          return (
            data.orderId.toLowerCase().includes(search) ||
            data.customer.toLowerCase().includes(search) ||
            data.product.toLowerCase().includes(search) ||
            data.orderDate.toLowerCase().includes(search) ||
            data.amount.toLowerCase().includes(search) ||
            data.payment.toLowerCase().includes(search) ||
            data.status.toLowerCase().includes(search)
          );
        });
      } else if (this.date !== null) {
        if (this.date !== null) {
          var date1 = this.date.split(" to ")[0];
          var date2 = this.date.split(" to ")[1];
        }
        return this.displayedPosts.filter((data) => {
          if (
            new Date(data.orderDate.slice(0, 12)) >= new Date(date1) &&
            new Date(data.orderDate.slice(0, 12)) <= new Date(date2)
          ) {
            return data;
          } else {
            return null;
          }
        });
      } else if (this.value !== null) {
        return this.displayedPosts.filter((data) => {
          if (data.status === this.value) {
            return data;
          } else {
            return null;
          }
        });
      } else if(this.value1 !== null) {
        return this.displayedPosts.filter((data) => {
          if (data.payment === this.value1) {
            return data;
          } else {
            return null;
          }
        });
      } else if(this.date !== null && this.value !== null && this.value1 !== null) {
        return this.displayedPosts.filter((data) => {
          if (
            new Date(data.orderDate.slice(0, 12)) >= new Date(date1) &&
            new Date(data.orderDate.slice(0, 12)) <= new Date(date2) &&
            data.status === this.value &&
            data.payment === this.value1
          ) {
            return data;
          } else {
            return null;
          }
        });
      } else {
        return this.displayedPosts;
      }
    },
  },
  watch: {
    orders() {
      this.setPages();
    },
    // resultQuery(newValue) {
    //   return newValue;
    // },
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
    onChangeStatus(e) {
      this.isStatus = e;
    },
    onChangePayment(e) {
      this.isPayment = e;
    },
    setPages() {
      let numberOfPages = Math.ceil(this.orders.length / this.perPage);
      for (let index = 1; index <= numberOfPages; index++) {
        this.pages.push(index);
      }
    },
    paginate(orders) {
      let page = this.page;
      let perPage = this.perPage;
      let from = page * perPage - perPage;
      let to = page * perPage;
      return orders.slice(from, to);
    },
    SearchData() {
      this.resultQuery;
      // var isstatus = document.getElementById("idStatus").value;
      //   var payment = document.getElementById("idPayment").value;
    },
  },
};
</script>

<template>
  <Layout>
    <PageHeader :title="title" :items="items" />
    <div class="row">
      <div class="col-lg-12">
        <div class="card" id="orderList">
          <div class="card-header border-0">
            <div class="d-flex align-items-center">
              <h5 class="card-title mb-0 flex-grow-1">Order History</h5>
              <div class="flex-shrink-0">
                <button
                  type="button"
                  class="btn btn-success add-btn"
                  data-bs-toggle="modal"
                  id="create-btn"
                  data-bs-target="#showModal"
                >
                  <i class="ri-add-line align-bottom me-1"></i> Create Order
                </button>
                <button type="button" class="btn btn-info ms-1">
                  <i class="ri-file-download-line align-bottom me-1"></i> Import
                </button>
              </div>
            </div>
          </div>
          <div
            class="card-body border border-dashed border-end-0 border-start-0"
          >
            <form>
              <div class="row g-3">
                <div class="col-xxl-5 col-sm-6">
                  <div class="search-box">
                    <input
                      type="text"
                      class="form-control search"
                      placeholder="Search for order ID, customer, order status or something..."
                    />
                    <i class="ri-search-line search-icon"></i>
                  </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-6">
                  <div>
                    <flat-pickr
                      placeholder="Select date"
                      v-model="date"
                      :config="config"
                      class="form-control flatpickr-input"
                      id="demo-datepicker"
                    ></flat-pickr>
                  </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-4">
                  <div>
                    <Multiselect
                      class="form-control"
                      v-model="value"
                      :close-on-select="true"
                      :searchable="true"
                      :create-option="true"
                      @input="onChangePayment"
                      :options="[
                        { value: '', label: 'Status' },
                        { value: 'All', label: 'All' },
                        { value: 'Pending', label: 'Pending' },
                        { value: 'Inprogress', label: 'Inprogress' },
                        { value: 'Cancelled', label: 'Cancelled' },
                        { value: 'Pickups', label: 'Pickups' },
                        { value: 'Returns', label: 'Returns' },
                        { value: 'Delivered', label: 'Delivered' },
                      ]"
                    />
                  </div>
                </div>
                <!--end col-->
                <div class="col-xxl-2 col-sm-4">
                  <div>
                    <Multiselect
                      class="form-control"
                      v-model="value1"
                      :close-on-select="true"
                      :searchable="true"
                      :create-option="true"
                      @input="onChangeStatus"
                      :options="[
                        { value: '', label: 'Select Payment' },
                        { value: 'All', label: 'All' },
                        { value: 'Mastercard', label: 'Mastercard' },
                        { value: 'Paypal', label: 'Paypal' },
                        { value: 'Visa', label: 'Visa' },
                        { value: 'COD', label: 'COD' },
                      ]"
                    />
                  </div>
                </div>
                <!--end col-->
                <div class="col-xxl-1 col-sm-4">
                  <div>
                    <button
                      type="button"
                      class="btn btn-primary w-100"
                      @click="SearchData"
                    >
                      <i class="ri-equalizer-fill me-1 align-bottom"></i>
                      Filters
                    </button>
                  </div>
                </div>
                <!--end col-->
              </div>
              <!--end row-->
            </form>
          </div>
          <div class="card-body pt-0">
            <div>
              <ul
                class="nav nav-tabs nav-tabs-custom nav-success mb-3"
                role="tablist"
              >
                <li class="nav-item">
                  <a
                    class="nav-link active All py-3"
                    data-bs-toggle="tab"
                    id="All"
                    href="#home1"
                    role="tab"
                    aria-selected="true"
                  >
                    <i class="ri-store-2-fill me-1 align-bottom"></i> All Orders
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link py-3 Delivered"
                    data-bs-toggle="tab"
                    id="Delivered"
                    href="#delivered"
                    role="tab"
                    aria-selected="false"
                  >
                    <i class="ri-checkbox-circle-line me-1 align-bottom"></i>
                    Delivered
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link py-3 Pickups"
                    data-bs-toggle="tab"
                    id="Pickups"
                    href="#pickups"
                    role="tab"
                    aria-selected="false"
                  >
                    <i class="ri-truck-line me-1 align-bottom"></i> Pickups
                    <span class="badge bg-danger align-middle ms-1">2</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link py-3 Returns"
                    data-bs-toggle="tab"
                    id="Returns"
                    href="#returns"
                    role="tab"
                    aria-selected="false"
                  >
                    <i class="ri-arrow-left-right-fill me-1 align-bottom"></i>
                    Returns
                  </a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link py-3 Cancelled"
                    data-bs-toggle="tab"
                    id="Cancelled"
                    href="#cancelled"
                    role="tab"
                    aria-selected="false"
                  >
                    <i class="ri-close-circle-line me-1 align-bottom"></i>
                    Cancelled
                  </a>
                </li>
              </ul>

              <div class="table-responsive table-card mb-1">
                <table class="table table-nowrap align-middle" id="orderTable">
                  <thead class="text-muted table-light">
                    <tr class="text-uppercase">
                      <th scope="col" style="width: 25px">
                        <div class="form-check">
                          <input
                            class="form-check-input"
                            type="checkbox"
                            id="checkAll"
                            value="option"
                          />
                        </div>
                      </th>
                      <th class="sort" data-sort="id">Order ID</th>
                      <th class="sort" data-sort="customer_name">Customer</th>
                      <th class="sort" data-sort="product_name">Product</th>
                      <th class="sort" data-sort="date">Order Date</th>
                      <th class="sort" data-sort="amount">Amount</th>
                      <th class="sort" data-sort="payment">Payment Method</th>
                      <th class="sort" data-sort="status">Delivery Status</th>
                      <th class="sort" data-sort="city">Action</th>
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
                          to="/ecommerce/order-details"
                          class="fw-medium link-primary"
                          >{{ data.orderId }}</router-link
                        >
                      </td>
                      <td class="customer_name">{{ data.customer }}</td>
                      <td class="product_name">{{ data.product }}</td>
                      <td class="date">
                        {{ data.orderDate }}
                        <small class="text-muted">02:21 AM</small>
                      </td>
                      <td class="amount">{{ data.amount }}</td>
                      <td class="payment">{{ data.payment }}</td>
                      <td class="status">
                        <span
                          :class="`badge badge-soft-${data.statusClass} text-uppercase`"
                          >{{ data.status }}</span
                        >
                      </td>
                      <td>
                        <ul class="list-inline hstack gap-2 mb-0">
                          <li
                            class="list-inline-item"
                            data-bs-toggle="tooltip"
                            data-bs-trigger="hover"
                            data-bs-placement="top"
                            title="View"
                          >
                            <router-link
                              to="/ecommerce/order-details"
                              class="text-primary d-inline-block"
                            >
                              <i class="ri-eye-fill fs-16"></i>
                            </router-link>
                          </li>
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
                              data-bs-target="#deleteOrder"
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
                    <p class="text-muted">
                      We've searched more than 150+ Orders We did not find any
                      orders for you search.
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
                      v-for="(pageNumber, index) in pages.slice(
                        page - 1,
                        page + 5
                      )"
                      :key="index"
                      @click="page = pageNumber"
                       :class="{
                              active: pageNumber == page,
                              disabled: pageNumber == '...',
                            }"
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
              aria-labelledby="exampleModalLabel"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
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

                      <div class="mb-3" id="modal-id">
                        <label for="orderId" class="form-label">ID</label>
                        <input
                          type="text"
                          id="orderId"
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
                        <label for="productname-field" class="form-label"
                          >Product</label
                        >
                        <select
                          class="form-control"
                          data-trigger
                          name="productname-field"
                          id="productname-field"
                        >
                          <option value="">Product</option>
                          <option value="Puma Tshirt">Puma Tshirt</option>
                          <option value="Adidas Sneakers">
                            Adidas Sneakers
                          </option>
                          <option value="350 ml Glass Grocery Container">
                            350 ml Glass Grocery Container
                          </option>
                          <option value="American egale outfitters Shirt">
                            American egale outfitters Shirt
                          </option>
                          <option value="Galaxy Watch4">Galaxy Watch4</option>
                          <option value="Apple iPhone 12">
                            Apple iPhone 12
                          </option>
                          <option value="Funky Prints T-shirt">
                            Funky Prints T-shirt
                          </option>
                          <option
                            value="USB Flash Drive Personalized with 3D Print"
                          >
                            USB Flash Drive Personalized with 3D Print
                          </option>
                          <option value="Oxford Button-Down Shirt">
                            Oxford Button-Down Shirt
                          </option>
                          <option value="Classic Short Sleeve Shirt">
                            Classic Short Sleeve Shirt
                          </option>
                          <option value="Half Sleeve T-Shirts (Blue)">
                            Half Sleeve T-Shirts (Blue)
                          </option>
                          <option value="Noise Evolve Smartwatch">
                            Noise Evolve Smartwatch
                          </option>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="date-field" class="form-label"
                          >Order Date</label
                        >
                        <flat-pickr
                          v-model="date2"
                          :config="timeConfig"
                          class="form-control"
                        ></flat-pickr>
                      </div>

                      <div class="row gy-4 mb-3">
                        <div class="col-md-6">
                          <div>
                            <label for="amount-field" class="form-label"
                              >Amount</label
                            >
                            <input
                              type="text"
                              id="amount-field"
                              class="form-control"
                              placeholder="Total amount"
                              required
                            />
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div>
                            <label for="payment-field" class="form-label"
                              >Payment Method</label
                            >
                            <select
                              class="form-control"
                              data-trigger
                              name="payment-method"
                              id="payment-field"
                            >
                              <option value="">Payment Method</option>
                              <option value="Mastercard">Mastercard</option>
                              <option value="Visa">Visa</option>
                              <option value="COD">COD</option>
                              <option value="Paypal">Paypal</option>
                            </select>
                          </div>
                        </div>
                      </div>

                      <div>
                        <label for="delivered-status" class="form-label"
                          >Delivery Status</label
                        >
                        <select
                          class="form-control"
                          data-trigger
                          name="delivered-status"
                          id="delivered-status"
                        >
                          <option value="">Delivery Status</option>
                          <option value="Pending">Pending</option>
                          <option value="Inprogress">Inprogress</option>
                          <option value="Cancelled">Cancelled</option>
                          <option value="Pickups">Pickups</option>
                          <option value="Delivered">Delivered</option>
                          <option value="Returns">Returns</option>
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
                          Add Order
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
                      colors="primary:#121331,secondary:#08a88a"
                      :options="defaultOptions"
                      :height="90"
                      :width="90"
                    />
                    <div class="mt-4 text-center">
                      <h4>You are about to delete a order ?</h4>
                      <p class="text-muted fs-15 mb-4">
                        Deleting your order will remove all of your information
                        from our database.
                      </p>
                      <div class="hstack gap-2 justify-content-center remove">
                        <button
                          class="btn btn-link link-success fw-medium text-decoration-none"
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
        </div>
      </div>
      <!--end col-->
    </div>
    <!--end row-->
  </Layout>
</template>
