<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            {{ Form::label('nombre_del_cuarto') }}
            {{ Form::text('name', $room->name, [
                'class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => 'Nombre del cuarto',
                'required',
            ]) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('piso') }}
            {{ Form::text('floor', $room->floor, [
                'class' => 'form-control' . ($errors->has('floor') ? ' is-invalid' : ''),
                'placeholder' => 'Piso',
                'required',
            ]) }}
            {!! $errors->first('floor', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('precio') }}
            {{ Form::text('price', $room->price, [
                'class' => 'form-control' . ($errors->has('price') ? ' is-invalid' : ''),
                'placeholder' => 'Precio',
                'required',
            ]) }}
            {!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
    </div>
</div>
