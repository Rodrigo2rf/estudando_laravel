@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Supermercados</h1>
@stop

@section('content')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<h4>Cadastrar</h4>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="post">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" required class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<h4>Cadastrados</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Estabelecimento</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($supermercados as $supermercado)
                            <tr>
                                <td>{{ $supermercado->nome }} </td>
                                <td><a title="Editar" class="btn btn-info float-left mr-2" href="{{ route('editar_supermercado',$supermercado->id) }}"><i class="far fa-edit"></i> Editar</a>
                                <form method="post" action="{{ route('excluir_supermercado',$supermercado->id) }}" onsubmit="return confirm('Tem certeza!?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger float-left"><i class="far fa-trash-alt"></i> Excluir</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop