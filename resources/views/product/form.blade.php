
<div class="card p-3">

    <div class="box-body">

        <div class="form-group my-2">
            {{ Form::label('Nombre') }}
            {{ Form::text('name', $product->name, ['class' => 'form-control my-2' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group my-2">
            {{ Form::label('Categoria') }}
            {{ Form::text('category', $product->category, ['class' => 'form-control my-2' . ($errors->has('category') ? ' is-invalid' : ''), 'placeholder' => 'Categoria']) }}
            {!! $errors->first('category', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group my-2">
            {{ Form::label('Precio') }}
            {{ Form::text('price', $product->price, ['class' => 'form-control my-2' . ($errors->has('price') ? ' is-invalid' : ''), 'placeholder' => 'Precio']) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer">
        <button type="submit" class="btn btn-primary">{{ __('Agregar') }}</button>
    </div>
</div>

