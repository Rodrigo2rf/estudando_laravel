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

<?php
    $melhor_preco = 0;
    foreach($produto as $key => $p){
        if($key == 0){
            $melhor_preco = $p->preco;;
        } else {
            if($melhor_preco > $p->preco){
                $melhor_preco = $p->preco;
            }
        }
    }
?>

<h4>{{ $produto[0]->produto }}</h4>

<br>

<div class="row">
    <div class="col-md-12">
        <div>
            <form method="post" action="{{ route('editar_produto', $produto[0]->produto_id) }}">
                <div class="card-body">
                    @csrf
                    <div class="form-group">
                        <label for="nome">Nome</label>
                        <input type="text" name="nome" value="{{ $produto[0]->produto }}" id="nome" required class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                            @foreach($produto as $key => $p)                            
                            <tr>
                                <td>{{ $p->supermercado }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->data)->format('d/m/Y') }}</td>
                                <td>R$ {{ number_format($p->preco,2,",",".") }} 
                                    <?php if($melhor_preco == $p->preco){
                                            echo '<span style="background: #5cb855; color:#fff; padding:5px 10px; margin-left:10px; border-radius:15px; font-size:14px;">Melhor preço</span>';
                                        }    
                                    ?>
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