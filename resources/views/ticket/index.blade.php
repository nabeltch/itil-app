@extends('layouts.app')

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
                                {{ __('Ticket') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
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
										<th>Reclamo</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $ticket->created_at }}</td>
											<td>{{ $ticket->client->name }}</td>
											<td>{{ $ticket->id_purchase }}</td>
											<td>{{ $ticket->client_problem }}</td>
                                            

                                            <td>
                                                
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tickets.show',$ticket->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    
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
