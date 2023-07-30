<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('template_title')
    {{ $room->name ?? "__('Ver') cuarto" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Ver') }} cuarto</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('rooms.index') }}"> {{ __('Volver') }}</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="form-group">
                            <strong>Nombre del cuarto:</strong>
                            {{ $room->name }}
                        </div>
                        <div class="form-group">
                            <strong>Piso:</strong>
                            {{ $room->floor }}
                        </div>
                        <div class="form-group">
                            <strong>Precio:</strong>
                            {{ $room->price }}
                        </div>
                        <form class="float-right" action="{{ route('rooms.destroy', $room->id) }}" method="POST">
                            <a class="btn btn-sm btn-success" href="{{ route('rooms.edit', $room->id) }}"><i
                                    class="fa fa-fw fa-edit"></i> {{ __('Modificar') }}</a>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i>
                                {{ __('Borrar') }}</button>
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