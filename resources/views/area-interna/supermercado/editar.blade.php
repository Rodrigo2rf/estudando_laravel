@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Supermercado</h1>
@stop

@section('content')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <img class="img-thumbnail" src="{{ $supermercado->logo_url }}">
                    <form method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" value="{{ $supermercado->nome }}" id="nome" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="logo">Logo</label>
                                <input type="file" name="logo" id="logo" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@stop