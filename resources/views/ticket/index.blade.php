@php
$type=explode("/",Request::path());
@endphp
@extends($type[0].'.layouts.app')
@section('template_title')
Ticket
@endsection

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

                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>
                                    <th>Fecha</th>
                                    <th>Cliente</th>
                                    <th>Compra</th>
                                    <th>Estado</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $data=['Publicado','Cancelado','En Proceso','Pendiente','Solucionado'];
                                @endphp
                                @foreach ($tickets as $ticket)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $ticket->created_at }}</td>
                                    <td>{{ $ticket->client->name }}</td>
                                    <td>{{ $ticket->id_purchase }}</td>
                                    <td>{{ $data[$ticket->state] }}</td>


                                    <td>

                                                <form action="{{ route('tickets.destroy',$ticket->id) }}" method="POST">

                                        <a class="btn btn-sm btn-primary " href="{{ route($type[0].'.tickets.show',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Ver mas') }}</a>
                                              
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
                </div>
            </div>
            {!! $tickets->links() !!}
        </div>
    </div>
</div>
@endsection