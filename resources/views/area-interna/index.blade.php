@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
    <h4>Olá {{ Auth::user()->name }}!</h4>
@stop

@section('content')

@foreach($feiras as $feira)
    {{ \Carbon\Carbon::parse($feira->data)->format('d/m/Y') }} - {{ $feira->nome }} | <a href="{{ route('informacoes_feira',$feira->id) }}">Ver</a><br>
@endforeach

@foreach($supermercados as $supermercado)
    {{ $supermercado->nome }} 
    <a href="{{ route('editar_supermercado',$supermercado->id) }}">Editar</a> |

    <form method="post" action="{{ route('excluir_supermercado',$supermercado->id) }}" onsubmit="return confirm('Tem certeza!?')">
        @csrf
        @method('DELETE')
        <button>Excluir</button>
    </form>
@endforeach

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop