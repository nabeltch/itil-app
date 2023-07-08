@php
$type=explode("/",Request::path());
$data_reaperture=['sin reapertura','con reapertura'];
$style_reaperture=['text-success','text-warning'];
@endphp
@extends($type[0].'.layouts.app')



@section('content')
<section class="content container-fluid">
  <div class="row text-center">

    <div class="card rounded-0 col-lg-12">
      <div class="card-body">
        <h5 class="card-title">Detalles del ticket {{$ticket->id}} <strong class="{{$style_reaperture[$ticket->reaperture]}}">{{ $data_reaperture[$ticket->reaperture] }}</strong></h5>

      </div>
    </div>

    <!-- <div class="row  flex-row text-center"> -->
    <div class="card rounded-0 col-lg-2">
      <div class="card-body">
        <h5 class="card-title">Código</h5>
        <p class="card-text">
          {{ $ticket->code }}
        </p>
      </div>
    </div>
    <div class="card rounded-0 col-lg-3">
      <div class="card-body">
        <h5 class="card-title">Fecha de creación</h5>
        <p class="card-text">
          {{ $ticket->created_at }}
        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-2">
      <div class="card-body">
        <h5 class="card-title">Cliente</h5>
        <p class="card-text">
          {{ $ticket->client->name }}
        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-2">
      <div class="card-body">
        <h5 class="card-title">Producto adquirido</h5>
        <p class="card-text">
          {{ $product_name }}
        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-3">
      <div class="card-body">
        <h5 class="card-title">Descripción del problema</h5>
        <p class="card-text">
          {{ $ticket->client_problem }}
        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-2">
      <div class="card-body">
        <h5 class="card-title">Ingeniero de Soporte TI</h5>
        <p class="card-text">
          @if($ticket->state==1)
          --
          @else
          {{ $ticket->support->name }}
          @endif


        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-3">
      <div class="card-body">
        <h5 class="card-title">Fecha inicial de soporte</h5>
        <p class="card-text">
          @if($ticket->state==1)
          --
          @else
          {{ $ticket->start_time_support }}
          @endif



        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-3">
      <div class="card-body">
        <h5 class="card-title">Fecha final de soporte</h5>
        <p class="card-text">
          @if($ticket->state==1)
          --
          @elseif($ticket->end_time_support=="")
          --
          @else
          {{ $ticket->end_time_support }}
          @endif



        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-4">
      <div class="card-body">
        <h5 class="card-title">Acciones realizadas</h5>
        <p class="card-text">
          @if($ticket->state==1)
          --
          @else
          {{ $ticket->actions_taken }}
          @endif



        </p>
      </div>
    </div>

    <div class="card rounded-0 col-lg-4">
      <div class="card-body">
        <h5 class="card-title">Resultados</h5>
        <p class="card-text">
          @if($ticket->state==1)
          --
          @else
          {{ $ticket->results }}
          @endif



        </p>
      </div>
    </div>
    @php

    $data=['Publicado','Cancelado','En Proceso','Solucionado'];
    $style=['bg-warning ','bg-danger','bg-primary','bg-success'];
    @endphp
    <div class="card rounded-0 col-lg-3">
      <div class="card-body">
        <h5 class="card-title">Estado</h5>
        <p class="card-text text-white {{$style[$ticket->state-1]}}">


          {{$data[$ticket->state-1]}}

        </p>
        @if (auth()->user()->type!=='client' && $ticket->state < 4 ) 
        <a class="btn btn-primary" href="{{ route('support.ticket.commit',[$ticket->id,$ticket->state])}}">Cambiar Estado</a>
        @endif
      </div>
    </div>
  </div>
  </div>
</section>


@endsection