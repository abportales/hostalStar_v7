<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('title', 'Crear renta')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Crear') }} renta</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rents.store') }}" role="form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">
                                        {{ Form::label('nombre_del_cuarto') }}
                                        {{ Form::select('room_id', $available_rooms, null, [
                                            'required',
                                            'class' => 'form-control' . ($errors->has('room_id') ? ' is-invalid' : ''),
                                        ]) }}
                                        {!! $errors->first('room_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    @include('rent.form')

                                    {{-- combobox de los tipos de pagos --}}
                                    <div class="form-group">
                                        {{ Form::label('Rentado_por') }}
                                        {{ Form::select('pay_type', $pay_time, null, [
                                            'required',
                                            'class' => 'form-control' . ($errors->has('pay_type') ? ' is-invalid' : ''),
                                        ]) }}
                                        {!! $errors->first('pay_type', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('Número de pagos') }}
                                        {{ Form::text('paid_weeks', $rent->paid_weeks, [
                                            'required',
                                            'class' => 'form-control' . ($errors->has('paid_weeks') ? ' is-invalid' : ''),
                                            'placeholder' => 'Semanas/Quincenas/Meses pagados',
                                        ]) }}
                                        {!! $errors->first('paid_weeks', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    <div class="form-group">
                                        {{ Form::label('fecha_de_inicio_([DD-MM-AAAA]_opcional)') }}
                                        @include('rent.datepicker')

                                        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
                                    <a class="btn btn-danger" href="{{ route('rents.index') }}"> {{ __('Cancelar') }}</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('/css/admin_custom.css')}}"> --}}
@stop
