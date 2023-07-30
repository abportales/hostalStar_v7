<div class="form-group">
    {{ Form::label('nombre_de_la_inquilina') }}
    {{ Form::text('renters_name', $rent->renters_name, [
        'required',
        'class' => 'form-control' . ($errors->has('renters_name') ? ' is-invalid' : ''),
        'placeholder' => 'Nombre de la inquilina',
    ]) }}
    {!! $errors->first('renters_name', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('inquilina_ine_ocr') }}
    {{ Form::text('renters_ine_ocr', $rent->renters_ine_ocr, [
        'class' => 'form-control' . ($errors->has('renters_ine_ocr') ? ' is-invalid' : ''),
        'placeholder' => 'Inquilina INE OCR',
    ]) }}
    {!! $errors->first('renters_ine_ocr', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('depósito') }}
    {{ Form::text('money_deposit', $rent->money_deposit, [
        'class' => 'form-control' . ($errors->has('money_deposit') ? ' is-invalid' : ''),
        'placeholder' => 'Deposito',
    ]) }}
    {!! $errors->first('money_deposit', '<div class="invalid-feedback">:message</div>') !!}
</div>
<div class="form-group">
    {{ Form::label('semanas_pagadas') }}
    {{ Form::text('paid_weeks', $rent->paid_weeks, [
        'required',
        'class' => 'form-control' . ($errors->has('paid_weeks') ? ' is-invalid' : ''),
        'placeholder' => 'Semanas pagadas',
    ]) }}
    {!! $errors->first('paid_weeks', '<div class="invalid-feedback">:message</div>') !!}
</div>
