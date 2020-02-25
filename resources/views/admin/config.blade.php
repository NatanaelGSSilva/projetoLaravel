@extends('layouts.admin')

@section('title', 'Configurações')

@section('content')
<h1>Configurações </h1>

    
    @alert
        Alguma frase qualquer
    @endalert
    @if(count($lista)>0)
        Lista de Bolo
    <ul>
        @foreach ($lista as $item)
            <li>{{$item}}</li>
        @endforeach

    </ul>
    @else
    Não Há Ingredientes
    @endif


<form action="" method="POST">
 @csrf
    Nome:<br/>
    <input type="text" name  = "nome"/><br/>
    Idade<br/>
    <input type="text" name = "idade"/><br/>
    Cidade<br/>
    <input type="text" name = "cidade"/><br/>

    <input type="submit" value ="Enviar"/>



</form>


<a href="/config/info">Informações</a>
@endsection