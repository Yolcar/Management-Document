@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    <h1 class="page-header">Editar Plantilla</h1>

    {{ Form::model($template,['route' => ['template.update',$template->id], 'method' => 'PUT', 'role' => 'form']) }}

    <div class="form-group">
        {{Form::hidden('typedocuments_id')}}
    </div>

    {{ Field::input('text','name') }}

    {{ Field::textarea('body',null) }}

    <p>
        <a href="{{Route('template.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina anterior de lista de plantillas" data-original-title="Atras">Atras</a>
        <input type="submit" value="Modificar" class="btn btn-custom-edit" data-toggle="popover" data-content="Permite modificar la Plantilla con los datos antes descritos" data-original-title="Modificar">
    </p>

    {{Form::close()}}

@endsection
