@extends('admin_it.mainAdminIt')

@section('home')
active
@endsection

@section('hal')

@endsection

@section('content')
<section class="section">
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class='card-heading p-1 pl-3'>Pengajuan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="pl-3">
                                <h1 class='mt-5'>{{ $bltot[0]->totbl }}</h1>
                                <p class='text-xs'><span class="text-green"><i data-feather="bar-chart" width="15"></i>
                                        @if ($bln == '01')
                                        {{ $total[0][0]->bl1 }}
                                        @elseif ($bln == '02')
                                        {{ $total[1][0]->bl2 }}
                                        @elseif ($bln == '03')
                                        {{ $total[2][0]->bl3 }}
                                        @elseif ($bln == '04')
                                        {{ $total[3][0]->bl4 }}
                                        @elseif ($bln == '05')
                                        {{ $total[4][0]->bl5 }}
                                        @elseif ($bln == '06')
                                        {{ $total[5][0]->bl6 }}
                                        @elseif ($bln == '07')
                                        {{ $total[6][0]->bl7 }}
                                        @elseif ($bln == '08')
                                        {{ $total[7][0]->bl8 }}
                                        @elseif ($bln == '09')
                                        {{ $total[8][0]->bl9 }}
                                        @elseif ($bln == '10')
                                        {{ $total[9][0]->bl10 }}
                                        @elseif ($bln == '11')
                                        {{ $total[10][0]->bl11 }}
                                        @elseif ($bln == '12')
                                        {{ $total[11][0]->bl12 }}
                                        @endif

                                    </span> pada bulan ini</p>
                                <div class="legends">
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-info me-2'></div><span class='text-xs'>Last
                                            Month</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-orange me-2'></div><span
                                            class='text-xs'>Current Month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@section('script')
<script src="{{ asset('assets/vendors/chartjs/Chart.min.js') }}"></script>

<script>
    var chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  info: '#41B1F9',
  blue: '#3245D1',
  purple: 'rgb(153, 102, 255)',
  grey: '#EBEFF6'
};
var ctxBar = document.getElementById("bar").getContext("2d");
var myBar = new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    datasets: [{
      label: 'Request',
      backgroundColor: [{{ $warna }}],
      data: [
        {{ $total[0][0]->bl1 }},
        {{ $total[1][0]->bl2 }},
        {{ $total[2][0]->bl3 }},
        {{ $total[3][0]->bl4 }},
        {{ $total[4][0]->bl5 }},
        {{ $total[5][0]->bl6 }},
        {{ $total[6][0]->bl7 }},
        {{ $total[7][0]->bl8 }},
        {{ $total[8][0]->bl9 }},
        {{ $total[9][0]->bl10 }},
        {{ $total[10][0]->bl11 }},
        {{ $total[11][0]->bl12 }}
      ]
    }]
  },
  options: {
    responsive: true,
    barRoundness: 1,
    title: {
      display: false,
      text: "JUDUL"
    },
    legend: {
      display: false
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          suggestedMax: 40 + 10,
          padding: 10,
        },
        gridLines: {
          drawBorder: false,
        }
      }],
      xAxes: [{
        gridLines: {
          display: false,
          drawBorder: false
        }
      }]
    }
  }
});


</script>

@endsection