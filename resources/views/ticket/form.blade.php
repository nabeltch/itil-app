
@php
$data=explode("/",Request::path());
@endphp

<div class="box box-info padding-1">
    <form method="POST" action="{{ route('tickets.store') }}" role="form" enctype="multipart/form-data">
        @csrf
        <div class="box-body">
            <div class="form-group">
                {{ Form::hidden('id_client', auth()->user()->id)}}
                {{ Form::hidden('id_purchase', $data[2])}}
                <input type="hidden" name="state" value="0">




            </div>


            <div class="form-group">
                {{ Form::label('Descripcion del reclamo') }}
                {{ Form::text('client_problem', $ticket->client_problem, ['class' => 'form-control my-1' . ($errors->has('client_problem') ? ' is-invalid' : ''), 'placeholder' => 'Reclamo']) }}
                {!! $errors->first('client_problem', '<div class="invalid-feedback">:message</div>') !!}
            </div>


        </div>
        <div class="box-footer mt-2">
            <button type="submit" class="btn btn-primary">{{ __('Generar') }}</button>
        </div>

    </form>
</div>
