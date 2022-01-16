@extends('template')

@section('conteudo')

@if(!empty($mensagem))
    <div class="alert alert-success">
        {{ $mensagem }}
    </div>
@endif

<h1>Olá {{ Auth::user()->name }}!</h1>

@foreach($feiras as $feira)
    {{ $feira->data }} - {{ $feira->nome }} | <a href="{{ route('informacoes_feira',$feira->id) }}">Ver</a><br>
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

<br><a href="{{ route('cadastrar_supermercado') }}">Cadastrar supermercado</a>
<br><a href="{{ route('cadastrar_feira') }}">Cadastrar feira</a>

@endsection