<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="{{ asset('backend/assets/images/logo/book.png')}}" type="image/x-icon" />
  <title>Admin Dashboard</title>

  <!-- ========== All CSS files linkup ========= -->
  <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/lineicons.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/fullcalendar.css') }}">
  <link rel="stylesheet" href="{{ asset('backend/assets/css/main.css') }}">
  <style>
    .initials-avatar {
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background-color: #365CF5;
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 16px;
      text-transform: uppercase;
    }

    .profile-info .image .initials-avatar {
      width: 100%;
      height: 100%;
    }

    .author-info .image .initials-avatar {
      width: 46px;
      height: 46px;
    }

    .table .lead-image .initials-avatar {
      width: 40px;
      height: 40px;
      font-size: 14px;
    }
  </style>

</head>

<body>
  <!-- ======== Preloader =========== -->
  <div id="preloader">
    <div class="spinner"></div>
  </div>
  <!-- ======== Preloader =========== -->

  <!-- ======== sidebar-nav start =========== -->
  @include('Admin.body.sidebar')
  <div class="overlay"></div>
  <!-- ======== sidebar-nav end =========== -->

  <!-- ======== main-wrapper start =========== -->
  <main class="main-wrapper">
    <!-- ========== header start ========== -->
    @include('Admin.body.header')
    <!-- ========== header end ========== -->

    <!-- ========== section start ========== -->
    @yield('Admin')
    <!-- ========== section end ========== -->

    <!-- ========== footer start =========== -->
    @include('Admin.body.footer')

    <!-- ========== footer end =========== -->
  </main>
  <!-- ======== main-wrapper end =========== -->

  <!-- ========= All Javascript files linkup ======== -->
  <script src="{{ asset('backend/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/Chart.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/dynamic-pie-chart.js') }}"></script>
  <script src="{{ asset('backend/assets/js/moment.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/fullcalendar.js') }}"></script>
  <script src="{{ asset('backend/assets/js/jvectormap.min.js') }}"></script>
  <script src="{{ asset('backend/assets/js/world-merc.js') }}"></script>
  <script src="{{ asset('backend/assets/js/polyfill.js') }}"></script>
  <script src="{{ asset('backend/assets/js/main.js') }}"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    @if(Session::has('message'))
      var type = "{{ Session::get('type', 'info') }}"
      switch (type) {
        case 'info':
          toastr.info(" {{ Session::get('message') }} ");
          break;

        case 'success':
          toastr.success(" {{ Session::get('message') }} ");
          break;

        case 'warning':
          toastr.warning(" {{ Session::get('message') }} ");
          break;

        case 'error':
          toastr.error(" {{ Session::get('message') }} ");
          break;
      }
    @endif 
  </script>


  <script>
      // ======== jvectormap activation


    var mapEl = document.getElementById("map");
    if (mapEl) {
      var jvm = new jsVectorMap({
        map: "world_merc",
        selector: "#map",
        zoomButtons: true,

        regionStyle: {
          initial: {
            fill: "#d1d5db",
          },
        },

        labels: {
          markers: {
            render: (marker) => marker.name,
          },
        },

        markersSelectable: true,
        selectedMarkers: markers.map((marker, index) => {
          var name = marker.name;

          if (name === "Russia" || name === "Brazil") {
            return index;
          }
        }),
        markers: markers,
        markerStyle: {
          initial: { fill: "#4A6CF7" },
          selected: { fill: "#ff5050" },
        },
        markerLabelStyle: {
          initial: {
            fontWeight: 400,
            fontSize: 14,
          },
        },
      });
    }
    // ====== calendar activation
    document.addEventListener("DOMContentLoaded", function () {
      var calendarMiniEl = document.getElementById("calendar-mini");
      if (calendarMiniEl) {
        var calendarMini = new FullCalendar.Calendar(calendarMiniEl, {
          initialView: "dayGridMonth",
          headerToolbar: {
            end: "today prev,next",
          },
        });
        calendarMini.render();
      }
    });

    // =========== chart one start
    const chart1El = document.getElementById("Chart1");
    if (chart1El) {
      const ctx1 = chart1El.getContext("2d");
      const chart1 = new Chart(ctx1, {
        type: "line",
        data: {
          labels: {!! json_encode($months ?? []) !!},
          datasets: [
            {
              label: "Borrows",
              backgroundColor: "transparent",
              borderColor: "#365CF5",
              data: {!! json_encode($borrowsCount ?? []) !!},
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#365CF5",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 5,
              borderWidth: 5,
              pointRadius: 8,
              pointHoverRadius: 8,
              cubicInterpolationMode: "monotone", // Add this line for curved line
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              callbacks: {
                labelColor: function (context) {
                  return {
                    backgroundColor: "#ffffff",
                    color: "#171717"
                  };
                },
              },
              intersect: false,
              backgroundColor: "#f9f9f9",
              title: {
                fontFamily: "Plus Jakarta Sans",
                color: "#8F92A1",
                fontSize: 12,
              },
              body: {
                fontFamily: "Plus Jakarta Sans",
                color: "#171717",
                fontStyle: "bold",
                fontSize: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
              bodyAlign: "center",
              titleAlign: "center",
              titleColor: "#8F92A1",
              bodyColor: "#171717",
              bodyFont: {
                family: "Plus Jakarta Sans",
                size: "16",
                weight: "bold",
              },
            },
            legend: {
              display: false,
            },
          },
          responsive: true,
          maintainAspectRatio: false,
          title: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 500,
              },
            },
            x: {
              grid: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
    }
    // =========== chart one end

    // =========== chart two start
    const chart2El = document.getElementById("Chart2");
    if (chart2El) {
      const ctx2 = chart2El.getContext("2d");
      const chart2 = new Chart(ctx2, {
        type: "bar",
        data: {
          labels: {!! json_encode($popularBookTitles ?? []) !!},
          datasets: [
            {
              label: "Borrows",
              backgroundColor: "#365CF5",
              borderRadius: 30,
              barThickness: 6,
              maxBarThickness: 8,
              data: {!! json_encode($popularBookCounts ?? []) !!},
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              callbacks: {
                titleColor: function (context) {
                  return "#8F92A1";
                },
                label: function (context) {
                  let label = context.dataset.label || "";

                  if (label) {
                    label += ": ";
                  }
                  label += context.parsed.y;
                  return label;
                },
              },
              backgroundColor: "#F3F6F8",
              titleAlign: "center",
              bodyAlign: "center",
              titleFont: {
                size: 12,
                weight: "bold",
                color: "#8F92A1",
              },
              bodyFont: {
                size: 16,
                weight: "bold",
                color: "#171717",
              },
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
            },
          },
          legend: {
            display: false,
          },
          legend: {
            display: false,
          },
          layout: {
            padding: {
              top: 15,
              right: 15,
              bottom: 15,
              left: 15,
            },
          },
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            },
            x: {
              grid: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                drawTicks: false,
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
          plugins: {
            legend: {
              display: false,
            },
            title: {
              display: false,
            },
          },
        },
      });
    }
    // =========== chart two end

    // =========== chart three start
    const chart3El = document.getElementById("Chart3");
    if (chart3El) {
      const ctx3 = chart3El.getContext("2d");
      const chart3 = new Chart(ctx3, {
        type: "line",
        data: {
          labels: ["This Month"],
          datasets: [
            {
              label: "Borrows",
              backgroundColor: "transparent",
              borderColor: "#365CF5",
              data: [{!! $thisMonthBorrows ?? 0 !!}],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#365CF5",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#365CF5",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
            {
              label: "Returns",
              backgroundColor: "transparent",
              borderColor: "#f2994a",
              data: [{!! $thisMonthReturns ?? 0 !!}],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#9b51e0",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#9b51e0",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
            {
              label: "Order",
              backgroundColor: "transparent",
              borderColor: "#f2994a",
              data: [180, 110, 140, 135, 100, 90, 145, 115, 100, 110, 115, 150],
              pointBackgroundColor: "transparent",
              pointHoverBackgroundColor: "#f2994a",
              pointBorderColor: "transparent",
              pointHoverBorderColor: "#f2994a",
              pointHoverBorderWidth: 3,
              pointBorderWidth: 5,
              pointRadius: 5,
              pointHoverRadius: 8,
              fill: false,
              tension: 0.4,
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              intersect: false,
              backgroundColor: "#fbfbfb",
              titleColor: "#8F92A1",
              bodyColor: "#272727",
              titleFont: {
                size: 16,
                family: "Plus Jakarta Sans",
                weight: "400",
              },
              bodyFont: {
                family: "Plus Jakarta Sans",
                size: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 15,
              },
              borderColor: "rgba(143, 146, 161, .1)",
              borderWidth: 1,
              enabled: true,
            },
            title: {
              display: false,
            },
            legend: {
              display: false,
            },
          },
          layout: {
            padding: {
              top: 0,
            },
          },
          responsive: true,
          // maintainAspectRatio: false,
          legend: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
              },
              max: 350,
              min: 50,
            },
            x: {
              grid: {
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                drawTicks: false,
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
    }
    // =========== chart three end

    // ================== chart four start
    const chart4El = document.getElementById("Chart4");
    if (chart4El) {
      const ctx4 = chart4El.getContext("2d");
      const chart4 = new Chart(ctx4, {
        type: "bar",
        data: {
          labels: {!! json_encode($categoryNames ?? []) !!},
          datasets: [
            {
              label: "Books",
              backgroundColor: "#365CF5",
              borderColor: "transparent",
              borderRadius: 20,
              borderWidth: 5,
              barThickness: 20,
              maxBarThickness: 20,
              data: {!! json_encode($categoryBookCounts ?? []) !!},
            },
            {
              label: "",
              backgroundColor: "#d50100",
              borderColor: "transparent",
              borderRadius: 20,
              borderWidth: 5,
              barThickness: 20,
              maxBarThickness: 20,
              data: [690, 740, 720, 1120, 876, 900],
            },
          ],
        },
        options: {
          plugins: {
            tooltip: {
              backgroundColor: "#F3F6F8",
              titleColor: "#8F92A1",
              titleFontSize: 12,
              bodyColor: "#171717",
              bodyFont: {
                weight: "bold",
                size: 16,
              },
              multiKeyBackground: "transparent",
              displayColors: false,
              padding: {
                x: 30,
                y: 10,
              },
              bodyAlign: "center",
              titleAlign: "center",
              enabled: true,
            },
            legend: {
              display: false,
            },
          },
          layout: {
            padding: {
              top: 0,
            },
          },
          responsive: true,
          // maintainAspectRatio: false,
          title: {
            display: false,
          },
          scales: {
            y: {
              grid: {
                display: false,
                drawTicks: false,
                drawBorder: false,
              },
              ticks: {
                padding: 35,
                max: 1200,
                min: 0,
              },
            },
            x: {
              grid: {
                display: false,
                drawBorder: false,
                color: "rgba(143, 146, 161, .1)",
                zeroLineColor: "rgba(143, 146, 161, .1)",
              },
              ticks: {
                padding: 20,
              },
            },
          },
        },
      });
    }
    // =========== chart four end
  </script>
</body>

</html>