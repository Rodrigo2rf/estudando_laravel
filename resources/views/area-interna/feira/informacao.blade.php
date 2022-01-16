@extends('template')

@section('conteudo')

<!-- Bootstrap DatePicker -->
<script type="text/javascript" src='https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.3.min.js'></script>
<script type="text/javascript" src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js'></script>
<link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/css/bootstrap.min.css' media="screen" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" type="text/css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js" type="text/javascript"></script>
<!-- Bootstrap DatePicker -->
<script type="text/javascript">
    $(function () {
        $('#txtDate').datepicker({
            format: "dd/mm/yyyy"
        });
    });
</script>

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<h2>{{ $feira->data }} - 
@foreach($supermercados as $supermercado)
    @if($supermercado->id == $feira->supermercado_id)
        {{ $supermercado->nome }}
    @endif
@endforeach
</h2>

<h3>Editar feira</h3>

<form method="post">
    @csrf

    <p>Data compra</p>
    <div class="input-group">
        <input id="txtDate" type="text" name="data" value="{{ $feira->data }}" class="form-control date-input" readonly="readonly" />
        <label class="input-group-btn" for="txtDate">
            <span class="btn btn-default">
                <span class="glyphicon glyphicon-calendar"></span>
            </span>
        </label>
    </div>

    <br>

    <p>Selecionar supermercado</p>
    <div class="form-group">
        <select class="form-control" name="supermercado">
            @foreach($supermercados as $supermercado)
            <option value="{{ $supermercado->id }}">{{ $supermercado->nome }}</option>
            @endforeach  
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Salvar edição</button>
</form>

<h3>Produtos adicionados ao carrinho</h3>

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
                    <button><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
                </form>
            </td>
        </tr>
        @endforeach
  </tbody>
</table>

<h4>Total: {{ number_format($total,2,",",".") }}</h4>

<h3>Adicionar produto ao carrinho</h3>

<form method="post">
    @csrf

    <p>Produto</p>
    <div class="form-group">
        <input type="text" name="nome" id="nome" required class="form-control">
    </div>

    <p>Preço</p>
    <div class="form-group">
        <input type="text" name="preco" id="preco" required class="form-control">
    </div>

    <p>Quantidade</p>
    <div class="form-group">
        <input type="text" name="quantidade" id="quantidade" required class="form-control">
    </div>

    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
</form>

<br><a href="{{ route('dashboard') }}">Voltar</a>

@endsection