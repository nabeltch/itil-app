@extends('admin.layouts.app')

@section('content')
<h1>ZONA PARA ADMINISTRADORES</h1>
@php
$type=explode("/",Request::path());

@endphp
<p>ruta:{{$type[0]}}</p>




@endsection