@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::model($document,['route' => ['document.index'], 'method' => 'GET', 'role' => 'form']) }}

    <div class="form-group text-center">
        <h1>Informacion del documento</h1>
        <h1 class="page-header">{{$document->name}}</h1>
    </div>
    <br>
    <div class="col-lg-12">
        {{$document->body}}
        <br>
        <br>
    </div>
    <p>
        <input type="submit" value="Atras" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina de lista de documentos creados" data-original-title="Atras">
    </p>

    {{Form::close()}}

@endsection
