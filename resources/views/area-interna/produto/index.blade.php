@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Produto</h1>
@stop

@section('content')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<h4>Listar</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th></th>
                            </tr>
                        </thead>
                            @foreach($produtos as $produto)
                            <tr>
                                <td>{{ $produto->nome }}</td>
                                <td><a href="{{ route('get_produtos', $produto->produto_id) }}">Ver histório | Editar</a></td>
                            </tr>
                            @endforeach
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@stop