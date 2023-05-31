@php
$type=explode("/",Request::path());
@endphp
@extends($type[0].'.layouts.app')



@section('content')
<section class="content container-fluid">
    <div class="row text-center">

    <div class="card rounded-0 col-lg-12">
    <div class="card-body">
      <h5 class="card-title">Detalles del ticket {{$ticket->id}}</h5>

    </div>
  </div>

    <!-- <div class="row  flex-row text-center"> -->
  <div class="card rounded-0 col-lg-2">
    <div class="card-body">
      <h5 class="card-title">Codigo</h5>
      <p class="card-text">
      {{ $ticket->id }}
      </p>
    </div>
  </div>
  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Fecha de creaciòn</h5>
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
      <h5 class="card-title">Cod. de compra</h5>
      <p class="card-text">
      {{ $ticket->id_purchase }}
      </p>
    </div>
  </div>

  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Reclamo del cliente</h5>
      <p class="card-text">
      {{ $ticket->client_problem }}
      </p>
    </div>
  </div>

  <div class="card rounded-0 col-lg-2">
    <div class="card-body">
      <h5 class="card-title">Soporte</h5>
      <p class="card-text">
      @if($ticket->state==0)
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
        @if($ticket->state==0)
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
        @if($ticket->state==0)
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
        @if($ticket->state==0)
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
        @if($ticket->state==0)
        --
        @else
        {{ $ticket->results }}
        @endif
        
      
    
      </p>
    </div>
  </div>

  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Estado</h5>
      <p class="card-text">
      @php
$data=['publicado','pendiente','solucionado'];
@endphp

      {{$data[$ticket->state]}}
 
      </p>
      @if (auth()->user()->type==='client')
                        @else
                        <a class="btn btn-primary" href="{{ route('support.ticket.commit',[$ticket->id,$ticket->state])}}">Cambiar Estado</a>
                        @endif
    </div>
  </div>
  </div>
</div>
</section>


@endsection

