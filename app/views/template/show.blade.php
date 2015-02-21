@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::model($template,['route' => ['template.index'], 'method' => 'GET', 'role' => 'form']) }}

    <h1 class="page-header">Informacion de la Plantilla: {{$template->name}}</h1>
    <br>
    <div class="col-lg-12">
        {{$template->body}}
        <br>
        <br>
    </div>
    <p>
        <input type="submit" value="Atras" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina anterior de lista de plantillas" data-original-title="Atras">
    </p>

    {{Form::close()}}

@endsection
