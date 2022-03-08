@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Feira: {{ \Carbon\Carbon::parse($feira->data)->format('d/m/Y') }} - 
    @foreach($supermercados as $supermercado)
        @if($supermercado->id == $feira->supermercado_id)
            {{ $supermercado->nome }}
        @endif
    @endforeach
    </h1>
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

 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js" type="text/javascript"></script>
  <script src="https://cdn.jsdelivr.net/gh/plentz/jquery-maskmoney@master/dist/jquery.maskMoney.min.js" type="text/javascript"></script>

<h4>Editar feira</h4>

        <div class="row">       
            <div class="col-md-12">
                <div class="card">
                    <form method="post" action="{{ route('informacoes_feira', $feira->id) }}">
                        <div class="card-body">
                            @csrf
                            <input type="hidden" name="action" value="editarFeira">

                            <label for="nome">Data da compra</label>
                            <x-adminlte-input-date name="data" value="{{ \Carbon\Carbon::parse($feira->data)->format('d/m/Y') }}" :config="$config" placeholder="Selecionar data...">
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
                                            <option value="{{ $supermercado->id }}" <?php if($supermercado->id == $feira->supermercado_id){ echo 'selected'; }?>>
                                                {{ $supermercado->nome }}
                                            </option>
                                    @endforeach  
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Salvar edição</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



<h4>Produtos adicionados ao carrinho</h4>

<div class="row">       
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

@if(count($produtosFeira) != 0)


<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Produto</th>
      <th scope="col">Preço</th>
      <th scope="col">Quantidade/Peso</th>
      <th scope="col">Preço final</th>
      <th>Excluir item</th>
    </tr>
    </thead>
    <tbody>
        @foreach($produtosFeira as $produto)
        <tr>
            <td>{{ $produto->nome }}</td>
            <td>{{ number_format($produto->preco,2,",",".") }}</td>
            <td>{{ $produto->quantidade }}</td>
            <td>{{ number_format($produto->preco_final,2,",",".") }}</td>
            <td>
                <form method="post" action="{{ route('excluir_item_carrinho',[$produto->item_id,$produto->id]) }}" onsubmit="return confirm('Tem certeza!?')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger float-left"><i class="far fa-trash-alt"></i> Excluir</button>
                </form>
            </td>
        </tr>
        @endforeach
  </tbody>
</table>
<br>
<h5>Total: R$ {{ number_format($total,2,",",".") }}</h5>

@else

    <p>Nenhum produto acidionado.</p>

@endif

            </div>
        </div>
    </div>
</div>

<h4>Adicionar produto ao carrinho</h4>
<div class="row">       
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">

<form method="post">
    @csrf
    
    <input type="hidden" name="action" value="adicionarProdutoAoCarrinho">

    <div class="form-group">
        <label for="produto">Produto</label>
        <input type="text" name="nome" id="produto_nome" required class="form-control" autocomplete="off">
        <div id="inputList"></div>
    </div>

    <div class="form-group">
        <label for="preco">Preço</label>
        <input type="text" data-thousands="." data-decimal="," data-prefix="R$ " name="preco" id="preco" required class="form-control">
    </div>

    <div class="form-group">
        <label for="quantidate">Quantidade/Peso</label>
        <input type="text" name="quantidade" id="quantidade" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
</form>

</div></div></div></div>

<br><a href="{{ route('dashboard') }}">Voltar</a>

<script>
    $(document).ready(function($){
        $("#preco").maskMoney({ allowZero:false, allowNegative:false, defaultZero:false });
    });
</script>

@stop

@section('css')
    <style>
        .form-group{
            position: relative;
        }
    </style>
@stop

@section('js')
    <script>
        $(function () {
            $('#produto_nome').keyup(function(){
                var string = $(this).val();
                if(string != ''){
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url: "{{ route('autocomplete_produtos') }}",
                        method: "POST",
                        data:{ string:string, _token:_token},
                        success:function(data)
                        {
                            $('#inputList').fadeIn();
                            $('#inputList').html(data);
                        }
                    })
                }
            });

            $(document).on('click','li', function(){
                $('#produto_nome').val($(this).text());
                $('#inputList').fadeOut();
            });

            $(document).on('click',function(){
                $('#inputList').fadeOut();
            });
        });
    </script>
@stop