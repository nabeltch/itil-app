@php
$user=auth()->user()->type
@endphp
@extends($user.'.layouts.app')
@section('content')
<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        Estados de tickets
      </div>
      <div class="card-body  text-center d-flex justify-content-between">

        <div class="col-lg-2">
          <div class="card bg-primary text-white">
            <div class="card-body">
              <h6 class="card-title">Total</h6>
              <h5 class="card-text">{{$collection[0]['total']}} Tickets </h6>
            </div>
          </div>

        </div>
        <div class="col-lg-2">
          <div class="card bg-success text-white">
            <div class="card-body">
              <h6 class="card-title">Solucionados</h6>
              <h5 class="card-text">{{$collection[4]['t_solved']}} Tickets</h5>
            </div>
          </div>

        </div>

        <div class="col-lg-2">
          <div class="card bg-info text-white">
            <div class="card-body">
              <h6 class="card-title">En proceso</h6>
              <h5 class="card-text">{{$collection[3]['t_progress']}} Tickets</h5>
            </div>
          </div>

        </div>

        <div class="col-lg-2">
          <div class="card bg-warning text-dark">
            <div class="card-body">
              <h6 class="card-title">Pendientes</h6>
              <h5 class="card-text">{{$collection[1]['t_slope']}} Tickets</h5>
            </div>
          </div>

        </div>


        <div class="col-lg-2">
          <div class="card bg-danger text-white">
            <div class="card-body">
              <h6 class="card-title">Cancelados</h6>
              <h5 class="card-text">{{$collection[2]['t_canceled']}} Tickets</h5>
            </div>
          </div>

        </div>



      </div>

    </div>
  </div>




</div>

<div class="row my-3">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
        Estadisticas
      </div>
      <div class="card-body" id="chart"></div>
    </div>
  </div>
</div>

@if(!$data_indicators==0)


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-header">
       <h4 class="card-title">Indicadores</h4>
      </div>
      <div class="card-body d-flex gap-3">
        <div class="col-lg-4">

          <div class="card">
            <div class="card-header">
              Indicador 1: Porcentaje de incidentes cerrados dentro de ANS
            </div>
            <div class="card-body">
              <h6 class="card-title">N° de incidentes cerrados que cumplen ANS: <strong>{{$data_indicators['indicator1']['quantity_tickets_ans']}} Tickets</strong></h6>
              <h6 class="card-title">Total de incidentes cerrados: <strong>{{$data_indicators['indicator1']['quantity_tickets']}} Tickets</strong></h6>
              <h4 class="card-title"><strong>Resultado: {{$data_indicators['indicator1']['result']}} %</strong></h4>
            </div>
          </div>

        </div>

        <div class="col-lg-4">

          <div class="card">
            <div class="card-header">
              Indicador 2: Tiempo promedio transcurrido para lograr la resolución de incidentes
            </div>
            <div class="card-body">
              <h6 class="card-title">Tiempo total de solución de incidentes: <strong>{{$data_indicators['indicator2']['total_time']}} Minutos</strong></h6>
              <h6 class="card-title">Total de incidentes cerrados en el mes: <strong>{{$data_indicators['indicator2']['quantity_tickets']}} Tickets</strong></h6>
              <h4 class="card-title"><strong>Resultado: {{$data_indicators['indicator2']['result']}} Minutos</strong></h4>
            </div>
          </div>

        </div>

        <div class="col-lg-4">

          <div class="card">
            <div class="card-header">
              Indicador 3: Porcentaje de solución de incidentes sin reapertura
            </div>
            <div class="card-body">
              <h6 class="card-title">N° de incidentes cerrados sin reapertura: <strong>{{$data_indicators['indicator3']['quantity_tickets_nr']}} Tickets</strong></h6>
              <h6 class="card-title">Total de incidentes cerrados: <strong>{{$data_indicators['indicator3']['quantity_tickets']}} Tickets</strong></h6>
              <h4 class="card-title"><strong>Resultado: {{$data_indicators['indicator3']['result']}} %</strong></h4>
            </div>
          </div>

        </div>

      </div>
    </div>

  </div>




</div>
@endif
</div>





<script>
  var data = @json($collection);
  // console.log(data)
  var options = {
    series: [{
      name: 'Total',
      data: [data[3]['t_progress'], data[4]['t_solved'], data[1]['t_slope'], data[2]['t_canceled']],
    }, ],
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
        formatter: function(val) {
          return val + " Tickets"
        }
      }
    }
  };


  var chart = new ApexCharts(document.querySelector("#chart"), options);

  chart.render();
</script>


@endsection