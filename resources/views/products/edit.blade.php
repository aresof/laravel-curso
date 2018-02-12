@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">{{ $error }}</div>
                @endforeach
            @endif
            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">{{ $client->name }}</h4>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $client->created_at }}</h6>
                    @if(Route::is('clients.create'))
                        <form action="{{route('clients.store')}}" method="post">
                    @else
                        <form action="{{route('clients.update', [$client->id])}}" method="post">
                            {{ method_field('PATCH') }}
                    @endif
                            {{ csrf_field() }}

                        <div class="input-group">
                            <label for="name">Nombre:</label>
                            <input id="name" class="form-control" type="text"
                                   placeholder="Nombre..." value="{{ $client->name }}" name="name">
                        </div>
                        <div class="input-group">
                            <label for="nif">NIF:</label>
                            <input id="nif" class="form-control" type="text"
                                   placeholder="NIF..." value="{{ $client->nif }}" name="nif">
                        </div>
                        <div class="input-group">
                            <label for="address">Dirección:</label>
                            <input id="address" class="form-control" type="text"
                                   placeholder="Dirección..." value="{{ $client->address }}" name="address">
                        </div>

                        <div class="radio">
                            <label>
                                <input type="radio" name="is_company" id="physical" value="0"
                                       @if(empty($client->is_company) || !$client->is_company) checked @endif>
                                Es persona física
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="is_company" id="company" value="1"
                                       @if($client->is_company) checked @endif>
                                Es empresa
                            </label>
                        </div>

                        <div class="input-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="address" class="form-control" type="text"
                                   placeholder="Dirección" value="{{ $client->address }}" name="address">
                        </div>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>
                </div>
            </div>


        </div>
    </div>
@endsection()