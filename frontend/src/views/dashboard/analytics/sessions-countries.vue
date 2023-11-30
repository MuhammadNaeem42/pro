<script>
export default {
  setup() {
    return {
      series: [
        {
          data: [1010, 1640, 490, 1255, 1050, 689, 800, 420, 1085, 589],
          name: "Sessions",
        },
      ],
      chartOptions: {
        chart: {
          type: "bar",
          height: 436,
          toolbar: {
            show: false,
          },
        },
        plotOptions: {
          bar: {
            borderRadius: 4,
            horizontal: true,
            distributed: true,
            dataLabels: {
              position: "top",
            },
          },
        },
        colors: [
          "#73dce9d9",
          "#73dce9d9",
          "#73dce9d9",
          "#73dce9d9",
          "#ff7f41d9",
          "#73dce9d9",
          "#73dce9d9",
          "#73dce9d9",
        ],
        dataLabels: {
          enabled: true,
          offsetX: 32,
          style: {
            fontSize: "12px",
            fontWeight: 400,
            colors: ["#adb5bd"],
          },
        },

        legend: {
          show: false,
        },
        grid: {
          show: false,
        },
        xaxis: {
          categories: [
            "India",
            "United States",
            "China",
            "Indonesia",
            "Russia",
            "Bangladesh",
            "Canada",
            "Brazil",
            "Vietnam",
            "UK",
          ],
        },
      },
    };
  },
};
</script>

<template>
  <div class="card card-height-100">
    <div class="card-header align-items-center d-flex">
      <h4 class="card-title mb-0 flex-grow-1">Sessions by Countries</h4>
      <div>
        <button type="button" class="btn btn-soft-secondary btn-sm me-1">ALL</button>
        <button type="button" class="btn btn-soft-primary btn-sm me-1">1M</button>
        <button type="button" class="btn btn-soft-secondary btn-sm">6M</button>
      </div>
    </div>
    <div class="card-body p-0">
      <div>
        <apexchart
          class="apex-charts"
          dir="ltr"
          height="436"
          :series="series"
          :options="chartOptions"
        ></apexchart>
      </div>
    </div>
    <!-- end card body -->
  </div>
  <!-- end card -->
</template>
