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

<h4></h4>

<br>

<h4>Histório de preços</h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Loja</th>
                                <th>Data</th>
                                <th>Preço</th>
                            </tr>
                        </thead>
                            @foreach($produto as $p)
                            <tr>
                                <td>{{ $p->supermercado }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->data)->format('d/m/Y') }}</td>
                                <td>{{ number_format($p->preco,2,",",".") }}</td>
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