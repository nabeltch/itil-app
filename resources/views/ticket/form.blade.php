@php
$data=explode("/",Request::path());
@endphp
<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::hidden('id_client', auth()->user()->id)}}
            {{ Form::hidden('id_purchase', $data[2])}}
            <input type="hidden" name="state" value="0">
          



        </div>


        <div class="form-group">
            {{ Form::label('client_problem') }}
            {{ Form::text('client_problem', $ticket->client_problem, ['class' => 'form-control' . ($errors->has('client_problem') ? ' is-invalid' : ''), 'placeholder' => 'Client Problem']) }}
            {!! $errors->first('client_problem', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>