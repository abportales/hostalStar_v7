<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('title', 'Ver cuarto')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Viendo: {{ $rent->renters_name }}</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rents.index') }}"> {{ __('Atras') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre del cuarto:</strong>
                            {{ $rent->room->name }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre de la inquilina:</strong>
                            {{ $rent->renters_name }}
                        </div>
                        <div class="form-group">
                            <strong>Inquilina INE OCR:</strong>
                            {{ $rent->renters_ine_ocr }}
                        </div>
                        <div class="form-group">
                            <strong>Semanas pagadas:</strong>
                            {{ $rent->paid_weeks }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de inicio:</strong>
                            {{ $rent->start_date->isoFormat('dddd, D MMMM Y') }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha de termino:</strong>
                            {{ $rent->end_date->isoFormat('dddd, D MMMM Y') }}
                        </div>

                        <div class="card-footer">
                            <div class="form-group">
                                <strong>Depósito:</strong>
                                ${{ $rent->money_deposit }}
                            </div>
                            <div class="form-group">
                                <strong>Precio de la renta:</strong>
                                ${{ $rent->room->price }}
                            </div>
                            <div class="form-group">
                                <strong>Saldo:</strong>

                                <span class="text-danger"> $
                                    {{ $balance = $rent->room->price * $rent->paid_weeks - $rent->money_deposit }} </span>
                            </div>
                        </div>
                        <a class="btn btn-sm btn-primary "
                            href="{{ route('general.charged', ['id' => $rent->id, 'balance' => $balance]) }}"><i
                                class="fa fa-fw fa-check"></i> {{ __('Cobrar') }}</a>
                        <form class="float-right" action="{{ route('rents.destroy', $rent->id) }}" method="POST">
                            <a class="btn btn-sm btn-success" href="{{ route('rents.edit', $rent->id) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Modificar') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                {{ __('Eliminar') }}</button>
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