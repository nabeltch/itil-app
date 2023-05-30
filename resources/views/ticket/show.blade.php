@extends('client.layouts.app')

@section('template_title')
{{ $ticket->name ?? "{{ __('Show') Ticket" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row text-center">

    <div class="card rounded-0 col-lg-12">
    <div class="card-body">
      <h5 class="card-title">Detalles del ticket {{$ticket->id}}</h5>

    </div>
  </div>

    <!-- <div class="row  flex-row text-center"> -->
  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Codigo</h5>
      <p class="card-text">
      {{ $ticket->id }}
      </p>
    </div>
  </div>
  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Fecha de generación</h5>
      <p class="card-text">
      {{ $ticket->created_at }}
      </p>
    </div>
  </div>

  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Cliente</h5>
      <p class="card-text">
      {{ $ticket->client->name }}
      </p>
    </div>
  </div>

  <div class="card rounded-0 col-lg-3">
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

  <div class="card rounded-0 col-lg-3">
    <div class="card-body">
      <h5 class="card-title">Soporte</h5>
      <p class="card-text">
      @if($ticket->state==0)
        --
        @else
        {{ $ticket->support->type }}
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
      <h5 class="card-title">Estado</h5>
      <p class="card-text">
      <form action="{{ route('tickets.add_support',$ticket->id) }}" method="post">
                        @csrf
      <select class="form-select" name="select" aria-label="Default select example">
      <option value="0">Publicado</option>
      <option value="1">pendiente</option>
      <option value="2">solucionado</option>

</select>         
               


                      
                        <input type="hidden" name="id_support" value="{{ auth()->user()->id }}">
                        @if (auth()->user()->type==='client')
                        @else
                        <input class="btn btn-primary" type="submit" value="Cambiar estado">
                        @endif
                        </form>
      </p>
    </div>
  </div>
  </div>
</div>
</section>

<script>
    user="{{auth()->user()->type}}"
    state="{{$ticket->state}}"
    document.querySelectorAll('.form-select option').forEach(element=>{

        if (element.value<=state){
            element.disabled=true
        }

        if (element.value==state){
            element.selected=true 
        }

    })


if(user=='client'){
    document.querySelector('.form-select').disabled=true
}
    console.log(user)
</script>
@endsection

