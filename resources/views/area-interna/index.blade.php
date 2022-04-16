@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <h4>Olá {{ Auth::user()->name }}!</h4>
@stop

@section('content')

<div class="row">
<div class="col-lg-3 col-6">

<div class="small-box bg-info">
<div class="inner">
<h3>{{$feiras}}</h3>
<p>Compras</p>
</div>
<div class="icon">
<i class="ion ion-bag"></i>
</div>
<a href="{{ route('cadastrar_feira') }}" class="small-box-footer">Saiba mais <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-success">
<div class="inner">
<h3>{{$supermercados}}</h3>
<p>Estabelecimentos</p>
</div>
<div class="icon">
<i class="ion ion-stats-bars"></i>
</div>
<a href="{{ route('form_supermercado') }}" class="small-box-footer">Saiba mais <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

<div class="col-lg-3 col-6">

<div class="small-box bg-warning">
<div class="inner">
<h3>{{ $produtos }}</h3>
<p>Produtos</p>
</div>
<div class="icon">
<i class="ion ion-person-add"></i>
</div>
<a href="{{ route('get_produtos') }}" class="small-box-footer">Saiba mais <i class="fas fa-arrow-circle-right"></i></a>
</div>
</div>

</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop