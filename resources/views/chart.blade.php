@extends('admin.layouts.app')
@section('content')
 
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card p-3" id="chart"></div>
            </div>
        </div>

    </div>

</body>
<script>
    var data= @json($collection);
    // console.log(data)
    var options = {
          series: [{
          name: 'app',
          data: [data[4]['t_solved'],data[1]['t_slope'],data[3]['t_progress'],data[2]['t_canceled']]
        },
        //  {
        //   name: 'Revenue',
        //   data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        // }, {
        //   name: 'Free Cash Flow',
        //   data: [35, 41, 36, 26, 45, 48, 52, 53, 41]
        // }
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
          formatter: function (val) {
            return val + "%";
          }
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Solucionados', 'Pendientes', 'En proceso', 'Cancelados'],
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
              return "$ " + val + " Tickets"
            }
          }
        }
        };


var chart = new ApexCharts(document.querySelector("#chart"), options);

chart.render();
</script>

</html>
@endsection