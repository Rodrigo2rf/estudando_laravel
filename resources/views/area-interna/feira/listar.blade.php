@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Compras</h1>
@stop

@section('content')

@section('plugins.TempusDominusBs4', true)

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

 <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Estabelecimento</th>
                                <th>Data</th>
                                <th>Valor total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feiras as $feira)
                            <tr>
                                <td>{{ $feira->nome }}</td>
                                <td>{{ \Carbon\Carbon::parse($feira->data)->format('d/m/Y') }}</td>
                                <td>@if($feira->preco_final != 0) R$ {{ number_format($feira->preco_final,2,",",".") }} @else - @endif</td>
                                <td><a title="Editar" class="btn btn-info float-left mr-2" href="{{ route('informacoes_feira',$feira->id) }}"><i class="fas fa-info"></i> Informações</a></td>
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

@section('css')
@stop

@section('js')
@stop