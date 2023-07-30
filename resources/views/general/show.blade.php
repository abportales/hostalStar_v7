<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('title', 'Resumen de ganacias')

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Resumen de ganancias</span>
                        </div>
                    </div>
                    <table class="table table-striped table-hover">
                        <thead class="thead">
                            <tr>
                                <th>Nombre del cuarto</th>
                                <th>Veces rentado</th>
                                <th>Ganancias</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rents as $rent)
                                <tr>
                                    <td>{{ $rent['name'] }}</td>
                                    <td>{{ $rent['rented_times'] }}</td>
                                    <td>${{ $rent['earnings'] }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td></td>
                                <td>Ganancias totales:</td>
                                <td>${{ $total }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('public/vendor/css/admin_custom.css') }}"> --}}
@stop
