<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('title', 'Actualizar renta')

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Modificar') }} Renta</span>
                    </div>
                    @if ($message = Session::get('danger'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                        </div>
                    @endif
                    <div class="card-body">
                        <form method="POST" action="{{ route('rents.update', $rent->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="box box-info padding-1">
                                <div class="box-body">
                                    <div class="form-group">

                                        {{ Form::label('nombre_del_cuarto') }}
                                        <select name="room_id">
                                            @foreach ($available_rooms as $room)
                                                <option value={{ $room->id }}
                                                    {{ $rent->room->name == $room->name ? 'selected="selected"' : '' }}>
                                                    {{ $room->name }}</option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('room_id', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                    @include('rent.form')

                                    <div class="form-group">
                                        {{ Form::label('fecha_de_inicio_([DD-MM-AAAA]_opcional)') }}
                                        {{ Form::text('start_date', substr($rent->start_date->format('d-m-Y'), 0, 10), [
                                            'class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : ''),
                                            'placeholder' => 'Fecha de inicio',
                                            'maxlength' => '10',
                                        ]) }}
                                        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
                                    </div>

                                </div>
                                <div class="box-footer mt20">
                                    <button type="submit" class="btn btn-primary">{{ __('Enviar') }}</button>
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