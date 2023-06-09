@extends('client.layouts.app')

@section('template_title')
    Purchase
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __(' Listado de Compras') }}
                            </span>
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
                                        <th>No</th>
                                        <th>Código</th>
                                        <th>Fecha</th>
										<th>Cliente</th>
										<th>Producto</th>
										<th>Cantidad</th>
										<th>Precio</th>
										<th>Total</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $key => $purchase)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $purchase->code }}</td>
                                            <td>{{ $purchase->created_at }}</td>
											<td>{{ $purchase->user->name }}</td>
											<td>{{ $purchase->product->name }}</td>
											<td>{{ $purchase->quantity }}</td>
											<td>${{ $purchase->price }}</td>
											<td>${{ $purchase->total }}</td>

                                            <td>
                                                <form action="{{ route('purchases.destroy',$purchase->id) }}" method="POST">
                                                <a class="btn btn-sm btn-primary " href="{{ route('tickets.generate',$purchase->id) }}"><i class="fa fa-fw fa-eye" disabled></i> {{ __('Generar ticket') }}</a>
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
                        {!! $purchases->links() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
