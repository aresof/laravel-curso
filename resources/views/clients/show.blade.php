@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if(session('status'))
                <div class="alert alert-success" role="alert">{{session('status')}}</div>
            @endif
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">{{ $client->name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $client->created_at }} </h6>
                    <p class="card-text">{{ $client->nif }}</p>
                    <p class="card-text">{{ $client->address }}</p>
                    <a href="{{route('clients.edit',[$client->id])}}" class="btn btn-primary">Editar</a>
                    <a href="#" class="btn btn-danger" onclick="hola()">Eliminar</a>
                </div>
            </div>
        </div>
    </div>
@endsection()