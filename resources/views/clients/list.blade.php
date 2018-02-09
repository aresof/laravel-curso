@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-block">
                    <h4 class="card-title">Lista de clientes</h4>
                    <h6 class="card-subtitle mb-2 text-muted">En total hay {{ $clients->total() }} clientes,
                    estás en la página {{$clients->currentPage()}} de {{ $clients->lastPage() }}</h6>
                    <p class="card-text">

                    @component('clients._table', ["clients" =>$clients ])
                        asdasd
                    @endcomponent

                    <div class="text-center">{{$clients->links()}}</div>
                </div>
            </div>


        </div>
    </div>
@endsection()