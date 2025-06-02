
    @extends('layout.master')

    @push('plugin-styles')
      <link href="{{ asset('assets/plugins/flatpickr/flatpickr.min.css') }}" rel="stylesheet" />
    @endpush

    @section('content')



<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  @if(!empty(Auth::user()->username))
  <div>
    <h4 class="mb-3 mb-md-0">Welcome {{Auth::user()->username}}</h4>
  </div>
  @endif
  <div class="d-flex align-items-center flex-wrap text-nowrap">
  <form action="{{ route('filteredDashboard') }}" class="d-flex align-items-center" method="post">
    @csrf
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate1">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
            <i data-feather="calendar" class="text-primary"></i>
        </span>
        <input name="startDate" type="date" class="form-control bg-transparent border-primary" placeholder="Select start date" >
    </div>
    <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate2">
        <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle>
            <i data-feather="calendar" class="text-primary"></i>
        </span>
        <input name="endDate" type="date" class="form-control bg-transparent border-primary" placeholder="Select end date" >
    </div>
    <button type="submit" class="btn btn-primary ms-2"><i class="link-icon" data-feather="filter"></i></button>
</form>

  </div>
</div>  

<div class="row">
  <div class="col-12 col-xl-12 stretch-card">
    <div class="row flex-grow-1">
    <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Total clients</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5 mt-2">
                <h3 class="mb-2 mt-2"></h3>
              </div>
                <div class="col-6 col-md-12 col-xl-7" style="margin-left: 60px;">
                  <!-- chart -->
                  <div id="totalClientsChart"></div>
                </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Active clients</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5 mt-2">
                <h3 class="mb-2 mt-2">{{$totalActive}} clients</h3>
              </div>
              <a href="{{ route('sorted', ['token' => 1]) }}">
                <div class="col-6 col-md-12 col-xl-7" style="margin-left: 60px;">
                  <!-- chart -->
                  <canvas id="activeClientsChart" style="height: 300px; width: 100%;"></canvas>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline">
              <h6 class="card-title mb-0">Inactive clients</h6>
            </div>
            <div class="row">
              <div class="col-6 col-md-12 col-xl-5">
                <h3 class="mb-2 mt-2">{{$totalInactive}} clients </h3>
              </div>
              <a href="{{ route('sorted',['token' =>2]) }}">
                <div class="col-6 col-md-12 col-xl-7" style="margin-left: 60px;">
                  <canvas id="inactiveClientsChart" style="height: 300px; width: 100%;"></canvas>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-6 col-xl-6 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Commandes confirmées</h6> 
        </div>
        <div class="row align-items-start mb-2">
          <div class="col-md-7">
          </div>
          <div class="col-md-5 d-flex justify-content-md-end">
            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
             <a href="{{ route('detailsCommandes',['token'=>1]) }}"><button type="button" class="btn btn-outline-primary">Details</button></a>
            </div>
          </div>
        </div>
        <div id="revenueChart"></div>
      </div>
    </div>
  </div>
  <div class="col-6 col-xl-6 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Commandes en attente</h6> 
        </div>
        <div class="row align-items-start mb-2">
          <div class="col-md-7">
          </div>
          <div class="col-md-5 d-flex justify-content-md-end">
            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
             <a href="{{ route('detailsCommandes',['token'=>2]) }}"><button type="button" class="btn btn-outline-primary">Details</button></a>
            </div>
          </div>
        </div>
        <div id="onHoldOrderChart"></div>
      </div>
    </div>
  </div>
</div> <!-- row -->

<div class="row">
  <div class="col-lg-7 col-xl-7 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Ventes annuelles</h6>
        </div>
        <div id="monthlySalesChart"></div>
      </div> 
    </div>
  </div>
</div>

@endsection

@push('plugin-scripts')
  <script src="{{ asset('assets/plugins/flatpickr/flatpickr.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
  <script src="{{ asset('/assets/js/dashboard.js') }}"></script>
@endpush

@push('custom-scripts')
  <script>

$(function() {
  'use strict';

  var colors = {
    primary        : "#6571ff",
    secondary      : "#7987a1",
    success        : "#05a34a",
    info           : "#66d1d1",
    warning        : "#fbbc06",
    danger         : "#ff3366",
    light          : "#e9ecef",
    dark           : "#060c17",
    muted          : "#7987a1",
    gridBorder     : "rgba(77, 138, 240, .15)",
    bodyColor      : "#000",
    cardBg         : "#fff"
  };

  var fontFamily = "'Roboto', Helvetica, sans-serif";

  var totalClientsData = {!! json_encode($totalClientsData) !!};
  var totalClientsCounts = {!! json_encode($totalClientsCounts) !!};

  if ($('#totalClientsChart').length) {
    var lineChartOptions = {
      chart: {
        type: 'bar',
        height: '400',
        parentHeightOffset: 0,
        foreColor: colors.bodyColor,
        background: colors.cardBg,
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: [colors.primary],
      grid: {
        padding: {
          bottom: -4,
        },
        borderColor: colors.gridBorder,
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [
        {
          name: 'Total Clients',
          data: totalClientsCounts
        },
      ],
      xaxis: {
        type: 'category',
        categories: totalClientsData,
        axisBorder: {
          color: colors.gridBorder,
        },
        axisTicks: {
          color: colors.gridBorder,
        },
      },
      yaxis: {
        title: {
          text: 'Total Clients',
        },
      },
      markers: {
        size: 0
      },
      stroke: {
        width: 2,
        curve: 'smooth'
      },
    };

    var totalClientsChart = new ApexCharts(document.querySelector("#totalClientsChart"), lineChartOptions);
    totalClientsChart.render();
  }

  
});
// END total clients


    document.addEventListener('DOMContentLoaded', function () {

      
        // Active Clients Chart
        const activeCtx = document.getElementById('activeClientsChart').getContext('2d');
        const activeClientsPerMonth = @json($activeClientsPerMonth);

        let cumulativeTotalActive = 0;
        const activeLabels = activeClientsPerMonth.map(item => `${item.year}-${String(item.month).padStart(2, '0')}`);
        const activeData = activeClientsPerMonth.map(item => {
            cumulativeTotalActive += item.active_clients;
            return cumulativeTotalActive;
        });

        new Chart(activeCtx, {
            type: 'bar',
            data: {
                labels: activeLabels,
                datasets: [{
                    label: 'Active Clients',
                    data: activeData,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: Math.max(...activeData) + 5 
                        }
                    }]
                }
            }
        });

        // Inactive Clients Chart
        const inactiveCtx = document.getElementById('inactiveClientsChart').getContext('2d');
        const inactiveClientsPerMonth = @json($inactiveClientsPerMonth);

        let cumulativeTotalInactive = 0;
        const inactiveLabels = inactiveClientsPerMonth.map(item => `${item.year}-${String(item.month).padStart(2, '0')}`);
        const inactiveData = inactiveClientsPerMonth.map(item => {
            cumulativeTotalInactive += item.inactive_clients;
            return cumulativeTotalInactive;
        });

        new Chart(inactiveCtx, {
            type: 'bar',
            data: {
                labels: inactiveLabels,
                datasets: [{
                    label: 'Inactive Clients',
                    data: inactiveData,
                    backgroundColor: 'rgba(255, 0, 0, 0.2)', 
                    borderColor: 'rgba(255, 0, 0, 1)',        
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: Math.max(...inactiveData) + 5 
                        }
                    }]
                }
            }
        });
    });

 // Commandes Confirmées
    $(function() {
      'use strict'

      var colors = {
        primary        : "#6571ff",
        secondary      : "#7987a1",
        success        : "#05a34a",
        info           : "#66d1d1",
        warning        : "#fbbc06",
        danger         : "#ff3366",
        light          : "#e9ecef",
        dark           : "#060c17",
        muted          : "#7987a1",
        gridBorder     : "rgba(77, 138, 240, .15)",
        bodyColor      : "#000",
        cardBg         : "#fff"
      }

      var fontFamily = "'Roboto', Helvetica, sans-serif"

      var ventesDates = {!! json_encode($monthlyDates) !!};
      var ventesCounts = {!! json_encode($monthlyCounts) !!};

      if ($('#revenueChart').length) {
        var lineChartOptions = {
          chart: {
            type: "line",
            height: '400',
            parentHeightOffset: 0,
            foreColor: colors.bodyColor,
            background: colors.cardBg,
            toolbar: {
              show: false
            },
          },
          theme: {
            mode: 'light'
          },
          tooltip: {
            theme: 'light'
          },
          colors: [colors.primary],
          grid: {
            padding: {
              bottom: -4,
            },
            borderColor: colors.gridBorder,
            xaxis: {
              lines: {
                show: true
              }
            }
          },
          series: [
            {
              name: "commandes",
              data: ventesCounts
            },
          ],
          xaxis: {
            type: "datetime",
            categories: ventesDates,
            lines: {
              show: true
            },
            axisBorder: {
              color: colors.gridBorder,
            },
            axisTicks: {
              color: colors.gridBorder,
            },
            crosshairs: {
              stroke: {
                color: colors.secondary,
              },
            },
          },
          yaxis: {
            title: {
              text: 'Nombre de commandes',
              style:{
                size: 9,
                color: colors.muted
              }
            },
            tickAmount: 4,
            labels: {
            formatter: function (value) {
              return Math.round(value); 
            }
          },
            tooltip: {
              enabled: true
            },
            crosshairs: {
              stroke: {
                color: colors.secondary,
              },
            },
          },
          markers: {
            size: 0,
          },
          stroke: {
            width: 2,
            curve: "smooth",
          },
        };
        var apexLineChart = new ApexCharts(document.querySelector("#revenueChart"), lineChartOptions);
        apexLineChart.render();
      }
    });
    // END Commandes Confirmées

// Commandes en attente
$(function() {
      'use strict'

      var colors = {
        primary        : "#6571ff",
        secondary      : "#7987a1",
        success        : "#05a34a",
        info           : "#66d1d1",
        warning        : "#fbbc06",
        danger         : "#ff3366",
        light          : "#e9ecef",
        dark           : "#060c17",
        muted          : "#7987a1",
        gridBorder     : "rgba(77, 138, 240, .15)",
        bodyColor      : "#000",
        cardBg         : "#fff"
      }

      var fontFamily = "'Roboto', Helvetica, sans-serif"

      var orderDates = {!! json_encode($monthlycommandesEnAttenteDates) !!};
      var orderCounts = {!! json_encode($monthlycommandesEnAttenteCounts) !!};

      if ($('#onHoldOrderChart').length) {
        var lineChartOptions = {
          chart: {
            type: "line",
            height: '400',
            parentHeightOffset: 0,
            foreColor: colors.bodyColor,
            background: colors.cardBg,
            toolbar: {
              show: false
            },
          },
          theme: {
            mode: 'light'
          },
          tooltip: {
            theme: 'light'
          },
          colors: [colors.primary],
          grid: {
            padding: {
              bottom: -4,
            },
            borderColor: colors.gridBorder,
            xaxis: {
              lines: {
                show: true
              }
            }
          },
          series: [
            {
              name: "Commandes",
              data: orderCounts
            },
          ],
          xaxis: {
            type: "datetime",
            categories: orderDates,
            lines: {
              show: true
            },
            axisBorder: {
              color: colors.gridBorder,
            },
            axisTicks: {
              color: colors.gridBorder,
            },
            crosshairs: {
              stroke: {
                color: colors.secondary,
              },
            },
          },
          yaxis: {
            title: {
              text: 'Nombre de commandes',
              style:{
                size: 9,
                color: colors.muted
              }
            },
            tickAmount: 4,
            tooltip: {
              enabled: true
            },
            crosshairs: {
              stroke: {
                color: colors.secondary,
              },
            },
          },
          markers: {
            size: 0,
          },
          stroke: {
            width: 2,
            curve: "smooth",
          },
        };
        var apexLineChart = new ApexCharts(document.querySelector("#onHoldOrderChart"), lineChartOptions);
        apexLineChart.render();
      }
    });
    // END Commandes en attente



    document.addEventListener('DOMContentLoaded', function () {
        var colors = {
            primary        : "#6571ff",
            secondary      : "#7987a1",
            success        : "#05a34a",
            info           : "#66d1d1",
            warning        : "#fbbc06",
            danger         : "#ff3366",
            light          : "#e9ecef",
            dark           : "#060c17",
            muted          : "#7987a1",
            gridBorder     : "rgba(77, 138, 240, .15)",
            bodyColor      : "#000",
            cardBg         : "#fff"
        }

        var fontFamily = "'Roboto', Helvetica, sans-serif"

        // Assuming `dates` and `counts` are passed as JavaScript variables
        var dates = @json($dates);
        var counts = @json($counts);

        if ($('#monthlySalesChart').length) {
            var options = {
                chart: {
                    type: 'bar',
                    height: '318',
                    parentHeightOffset: 0,
                    foreColor: colors.bodyColor,
                    background: colors.cardBg,
                    toolbar: {
                        show: false
                    },
                },
                theme: {
                    mode: 'light'
                },
                tooltip: {
                    theme: 'light'
                },
                colors: [colors.primary],
                fill: {
                    opacity: .9
                },
                grid: {
                    padding: {
                        bottom: -4
                    },
                    borderColor: colors.gridBorder,
                    xaxis: {
                        lines: {
                            show: true
                        }
                    }
                },
                series: [{
                    name: 'Sales',
                    data: counts
                }],
                xaxis: {
                    categories: dates,
                    axisBorder: {
                        color: colors.gridBorder,
                    },
                    axisTicks: {
                        color: colors.gridBorder,
                    },
                },
                yaxis: {
                    title: {
                        text: 'Number of Sales',
                        style: {
                            size: 9,
                            color: colors.muted
                        }
                    },
                },
                legend: {
                    show: true,
                    position: "top",
                    horizontalAlign: 'center',
                    fontFamily: fontFamily,
                    itemMargin: {
                        horizontal: 8,
                        vertical: 0
                    },
                },
                stroke: {
                    width: 0
                },
                dataLabels: {
                    enabled: true,
                    style: {
                        fontSize: '10px',
                        fontFamily: fontFamily,
                    },
                    offsetY: -27
                },
                plotOptions: {
                    bar: {
                        columnWidth: "10%",
                        borderRadius: 4,
                        dataLabels: {
                            position: 'top',
                            orientation: 'vertical',
                        }
                    },
                },
            }

            var apexBarChart = new ApexCharts(document.querySelector("#monthlySalesChart"), options);
            apexBarChart.render();
        }
    });

   
  </script>
@endpush

