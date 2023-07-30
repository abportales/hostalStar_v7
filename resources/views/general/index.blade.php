<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('title', 'Proximo a vencer')

@section('content_header')
    <h1>Proximos a vencer</h1>
@stop

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                <p>{{ $message }}</p>
                            </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Nombre del cuarto</th>
                                        <th>Nombre de la inquilina</th>
                                        <th>Depósito</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de termino</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rents as $rent)
                                        <tr>
                                            <td>{{ $rent->room->name }}</td>
                                            <td>{{ $rent->renters_name }}</td>
                                            <td>${{ $rent->money_deposit }}</td>
                                            <td>{{ $rent->start_date->isoFormat('dddd, D MMMM Y') }}</td>
                                            <td class="text-danger"> {{ $rent->end_date->isoFormat('dddd, D MMMM Y') }}</td>
                                            <td>
                                                <form action="{{ route('rents.destroy', $rent->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('rents.show', $rent->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Ver') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('rents.edit', $rent->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Modificar') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Eliminar') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('public/vendor/css/admin_custom.css')}}"> --}}
@stop