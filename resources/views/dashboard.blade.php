@php
$user=auth()->user()->type
@endphp
@extends($user.'.layouts.app')
@section('content')
<div class="row text-center justify-content-around">
    <div class="col-lg-2">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">Total</h5>
                <p class="card-text">{{$collection[0]['total']}} Tickets </p>
            </div>
        </div>

    </div>

    <div class="col-lg-2">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">Solucionados</h5>
                <p class="card-text">{{$collection[4]['t_solved']}} Tickets</p>
            </div>
        </div>

    </div>

    <div class="col-lg-2">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">En proceso</h5>
                <p class="card-text">{{$collection[3]['t_progress']}} Tickets</p>
            </div>
        </div>

    </div>

    <div class="col-lg-2">
        <div class="card bg-warning text-dark">
            <div class="card-body">
                <h5 class="card-title">Pendientes</h5>
                <p class="card-text">{{$collection[1]['t_slope']}} Tickets</p>
            </div>
        </div>

    </div>


    <div class="col-lg-2">
        <div class="card bg-danger text-white">
            <div class="card-body">
                <h5 class="card-title">Cancelados</h5>
                <p class="card-text">{{$collection[2]['t_canceled']}} Tickets</p>
            </div>
        </div>

    </div>
</div>

<div class="row my-3">
    <div class="col-lg-12">
        <div class="card p-3" id="chart"></div>
    </div>
</div>





<script>
    var data= @json($collection);
    // console.log(data)
    var options = {
          series: [{
          name: 'Total',
          data: [data[3]['t_progress'],data[4]['t_solved'],data[1]['t_slope'],data[2]['t_canceled']],
        },
    ],
          chart: {
          type: 'bar',
          height: 350
        },
        plotOptions: {
          bar: {
            distributed: true,
            horizontal: false,
            columnWidth: '50%',
            endingShape: 'rounded',
          },
        },
        dataLabels: {
          enabled: true,
        //   formatter: function (val) {
        //     return val + "%";
        //   }
         },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['En proceso', 'Solucionados', 'Pendientes', 'Cancelados'],
        },
        yaxis: {
          title: {
            text: 'Tickets'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return  val + " Tickets"
            }
          }
        }
        };


var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script>


@endsection