@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Feiras</h1>
@stop

@section('content')

@section('plugins.TempusDominusBs4', true)

@php
    $config = ['format' => 'DD/MM/YYYY'];
@endphp

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif


<h4>Cadastrar</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="post">
                        <div class="card-body">
                            @csrf
                            <label for="nome">Data da compra</label>
                            <x-adminlte-input-date name="data" :config="$config" placeholder="Selecionar data...">
                                <x-slot name="appendSlot">
                                    <div class="input-group-text bg-gradient-success">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </x-slot>
                            </x-adminlte-input-date>

                            <div class="form-group">
                                <label for="nome">Selecionar supermercado</label>
                                <select class="form-control" name="supermercado">
                                    @foreach($supermercados as $supermercado)
                                    <option value="{{ $supermercado->id }}">{{ $supermercado->nome }}</option>
                                    @endforeach  
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<h4>Últimas feiras <span class="small">(<a href="#">ver todas</a>)</span></h4>

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