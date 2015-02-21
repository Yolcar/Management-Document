@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Editar Tipo de Documento</h1>

    {{ Form::model($type_document,['route' => ['type_document.update',$type_document->id], 'method' => 'PUT', 'role' => 'form']) }}

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
        <input type="submit" value="Modificar" class="btn btn-success">
    </p>

    {{Form::close()}}

@endsection
