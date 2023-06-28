@extends('client.layouts.app')

@section('content')
<h1>ZONA PARA CLIENTES</h1>
<h1>total tickets: {{$collection[0]['total']}}</h1>

<h1>total solucionados: {{$collection[1]['t_slope']}}</h1>
<h1>tickets pendientes: {{$collection[2]['t_canceled']}}</h1>

@endsection