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

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post">
    @csrf

    <p>Data compra:</p>
    <div class="input-group">
        <input id="txtDate" type="text" name="data" class="form-control date-input" readonly="readonly" />
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

    <button type="submit" class="btn btn-primary mt-3">Cadastrar</button>
</form>
@endsection