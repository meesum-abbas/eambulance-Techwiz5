@extends('AdminPannel.app')

@section('title', 'Rapid Rescue - Admin Home Page')

@section('content')

      <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title d-flex align-items-center gap-2 mb-4">
                            User and Driver Growth Over the Last 7 Days
                            <span>
                                <iconify-icon icon="solar:question-circle-bold" class="fs-7 d-flex text-muted" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-success" data-bs-title="Traffic Overview"></iconify-icon>
                            </span>
                        </h5>
                        <div id="traffic-overview"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="py-6 px-6 text-center">
          <p class="mb-0 fs-4">Design and Developed by <a href="/" target="_blank"
              class="pe-1 text-primary text-decoration-underline">E- Ambulance</a></p>
        </div>
      </div>
    </div>
    @section('scripts')
    <script>
        $(function () {
            var userCounts = @json($userCounts);
            var driverCounts = @json($driverCounts);

            while (userCounts.length < 7) userCounts.unshift(0);
            while (driverCounts.length < 7) driverCounts.unshift(0);

            var chart = {
                series: [
                    {
                        name: "Users",
                        data: userCounts,
                    },
                    {
                        name: "Drivers",
                        data: driverCounts,
                    },
                ],
                chart: {
                    toolbar: {
                        show: false,
                    },
                    type: "line",
                    fontFamily: "inherit",
                    foreColor: "#adb0bb",
                    height: 320,
                    stacked: false,
                },
                colors: ["var(--bs-gray-300)", "var(--bs-primary)"],
                dataLabels: {
                    enabled: false,
                },
                legend: {
                    show: false,
                },
                stroke: {
                    width: 2,
                    curve: "smooth",
                    dashArray: [8, 0],
                },
                grid: {
                    borderColor: "rgba(0,0,0,0.1)",
                    strokeDashArray: 3,
                    xaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                    },
                    categories: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                },
                yaxis: {
                    tickAmount: 4,
                },
                markers: {
                    strokeColor: ["var(--bs-gray-300)", "var(--bs-primary)"],
                    strokeWidth: 2,
                },
                tooltip: {
                    theme: "dark",
                },
            };

            var chart = new ApexCharts(
                document.querySelector("#traffic-overview"),
                chart
            );
            chart.render();
        });
    </script>
    @endsection
@endsection
