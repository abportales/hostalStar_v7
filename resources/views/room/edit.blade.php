<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
@extends('adminlte::page')

@section('template_title')
    {{ __('Modificar') }} cuarto
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')
                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Modificar') }} cuarto</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('rooms.update', $room->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('room.form')

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