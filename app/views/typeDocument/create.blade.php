@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

<h1 class="page-header">Nuevo Tipo de Documento</h1>

{{ Form::open(['route' => 'type_document.store', 'method' => 'POST', 'role' => 'form']) }}

    <div class="form-group">
        {{Form::label('name','Nombre')}}
        {{Form::text('name')}}

        @if($errors->has())
            @foreach ($errors->all() as $error)
                <div class="error_message">{{ $error }}</div>
            @endforeach
        @endif

    </div>

<p>
    <a href="{{Route('type_document.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los tipos de documentos creados" data-original-title="Atras">Atras</a>
    <input type="submit" value="Crear" class="btn btn-custom-create" data-toggle="popover" data-content="Permite Crear los Nuevos tipos de documentos." data-original-title="Crear Tipo">
</p>


{{Form::close()}}

@endsection