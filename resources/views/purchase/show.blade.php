@extends('layouts.app')

@section('template_title')
    {{ $purchase->name ?? "{{ __('Show') Purchase" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Purchase</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('purchases.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id User:</strong>
                            {{ $purchase->id_user }}
                        </div>
                        <div class="form-group">
                            <strong>Id Product:</strong>
                            {{ $purchase->id_product }}
                        </div>
                        <div class="form-group">
                            <strong>Quantity:</strong>
                            {{ $purchase->Quantity }}
                        </div>
                        <div class="form-group">
                            <strong>Price:</strong>
                            {{ $purchase->price }}
                        </div>
                        <div class="form-group">
                            <strong>Total:</strong>
                            {{ $purchase->total }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
