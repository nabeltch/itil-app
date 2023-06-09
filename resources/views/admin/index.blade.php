@extends('admin.layouts.app')

@section('template_title')
    Product
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                @php
                                $users_type1=['admin'=>'administradores','client'=>'clientes','support'=>'soportes'];
                                $users_type2=['admin'=>'Administrador','client'=>'Cliente','support'=>'Soporte'];
                                @endphp
                                Lista de {{__($users_type1[$type]) }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('admin.users.create',$type) }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Crear nuevo') }}
                                </a>
                              </div>
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
										<th>Nombre</th>
										<th>Email</th>
                                        <th>Tipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $key=>$user)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$user->code}}</td>
											<td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
											<td>{{ $users_type2[$user->type] }}</td>

                                            <td>
                                                
                                                <form action="{{ route('admin.users.destroy',[$user->id,$type]) }}" method="POST">
                                                    <!-- <a class="btn btn-sm btn-primary " href="{{ route('products.show',$user->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> -->
                                                    <a class="btn btn-sm btn-success" href="{{ route('admin.users.edit',[$type,$user->id]) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Editar') }}</a>
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
                        {!! $users->links() !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
@endsection
