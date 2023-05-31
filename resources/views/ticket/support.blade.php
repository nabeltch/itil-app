@php
$data=explode("/",Request::path());
@endphp
@extends('client.layouts.app')

@section('content')
@php
$data=explode("/",Request::path());
@endphp
<form method="POST" action="{{ route('support.add_support') }}" role="form" enctype="multipart/form-data">
    @csrf




    <input type="hidden" name="id_support" value="{{ auth()->user()->id }}">
    <input type="hidden" name="id_ticket" value="{{ $data[3] }}">





    <div class="row mb-3">
        <label for="actions" class="col-md-4 col-form-label text-md-end">{{ __('Acciones Realizadas') }}</label>

        <div class="col-md-6">
            <input id="actions" type="text" class="form-control @error('actions') is-invalid @enderror" name="actions" required autocomplete="actions" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="results" class="col-md-4 col-form-label text-md-end">{{ __('Resultados') }}</label>

        <div class="col-md-6">
            <input id="results" type="text" class="form-control @error('results') is-invalid @enderror" name="results" required autocomplete="results" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>


    <div class="row mb-3">
        <label for="select" class="col-md-4 col-form-label text-md-end">{{ __('Estado') }}</label>

        <div class="col-md-6">
            <select class="form-select" name="select" aria-label="Default select example">
                <option value="0">Publicado</option>
                <option value="1">pendiente</option>
                <option value="2">solucionado</option>

            </select>

        </div>
    </div>



    <div class="row mb-0">
        <div class="col-md-6 offset-md-4">

            @if (auth()->user()->type==='client')
            @else
            <input class="btn btn-primary" type="submit" value="Cambiar estado">
            @endif
        </div>
    </div>

</form>

<script>
    user = "{{auth()->user()->type}}"
    state = "{{$data[4]}}"
    document.querySelectorAll('.form-select option').forEach(element => {

        if (element.value <= state) {
            element.disabled = true
        }

        if (element.value == state) {
            element.selected = true
        }

    })


    if (user == 'client') {
        document.querySelector('.form-select').disabled = true
    }
    console.log(user)
</script>


@endsection