@php
$user=auth()->user()->type
@endphp
@extends($user.'.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Listado Tickets') }}
                        </span>
                        @if($user=='admin')
                        <div class="float-right">
                            <a href="{{ route('tickets_export') }}" class="btn btn-success btn-sm float-right" data-placement="left">
                                {{ __('Exportar Excel') }}
                            </a>
                        </div>
                        @endif

                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Id_Compra</th>
                                    <th>Estado</th>
                                    <th>Reapertura</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $data_state=['Publicado','Cancelado','En Proceso','Solucionado'];
                                $style_state=['text-warning','text-danger','text-primary','text-success'];

                                $data_reaperture=['No','Si'];
                                $style_reaperture=['text-success','text-warning'];
                                @endphp
                                @foreach ($tickets as $key => $ticket)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $ticket->code }}</td>
                                    <td>{{ $ticket->created_at }}</td>
                                    <td>{{ $ticket->client->name }}</td>
                                    <td>{{ $ticket->purchase->code }}</td>
                                    <td><strong class="{{$style_state[$ticket->state-1]}}">{{ $data_state[$ticket->state-1] }}</strong></td>
                                    <td><strong class="{{$style_reaperture[$ticket->reaperture]}}">{{ $data_reaperture[$ticket->reaperture] }}</strong></td>

                                    <td>

                                        <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">

                                            <a class="btn btn-sm btn-primary " href="{{ route($user.'.tickets.show',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver mas') }}</a>
                                            @if($ticket->state==4 && $user=='client')
                                            <a class="btn btn-sm btn-info " href="{{ route('tickets.reaperture',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Reaperturar') }}</a>
                                            @endif
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $tickets->links() !!}
                    </div>
                </div>
            </div>

        </div>
@if($user=='support')
        <div class="col-sm-12 my-3">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Mis Tickets') }}
                        </span>
                        @if($user=='admin')
                        <div class="float-right">
                            <a href="{{ route('tickets_export') }}" class="btn btn-success btn-sm float-right" data-placement="left">
                                {{ __('Exportar Excel') }}
                            </a>
                        </div>
                        @endif

                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Código</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Id_Compra</th>
                                    <th>Estado</th>
                                    <th>Reapertura</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $data_state=['Publicado','Cancelado','En Proceso','Solucionado'];
                                $style_state=['text-warning','text-danger','text-primary','text-success'];

                                $data_reaperture=['No','Si'];
                                $style_reaperture=['text-success','text-warning'];
                                @endphp
                                @foreach ($tickets_support as $key => $ticket)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $ticket->code }}</td>
                                    <td>{{ $ticket->created_at }}</td>
                                    <td>{{ $ticket->client->name }}</td>
                                    <td>{{ $ticket->purchase->code }}</td>
                                    <td><strong class="{{$style_state[$ticket->state-1]}}">{{ $data_state[$ticket->state-1] }}</strong></td>
                                    <td><strong class="{{$style_reaperture[$ticket->reaperture]}}">{{ $data_reaperture[$ticket->reaperture] }}</strong></td>

                                    <td>

                                        <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">

                                            <a class="btn btn-sm btn-primary " href="{{ route($user.'.tickets.show',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver mas') }}</a>
                                            @if($ticket->state==4 && $user=='client')
                                            <a class="btn btn-sm btn-info " href="{{ route('tickets.reaperture',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Reaperturar') }}</a>
                                            @endif
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                        </form>

                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>


                    </div>
                    <div class="d-flex justify-content-center">
                        {!! $tickets_support->links() !!}
                    </div>
                </div>
            </div>

        </div>
@endif

    </div>
</div>
@endsection