@extends('layout')
@extends('navbar')
@extends('sidebar')
@section('body')

    <h1 class="page-header">Nuevo Documento</h1>


    {{ Form::open(['route' => 'document.store', 'method' => 'POST', 'role' => 'form']) }}

    <div class="form-group">
        {{Form::hidden('templates_id',$template->id,['id' => 'templates_id'])}}
    </div>
    <div class="col-lg-12">
        <div class="col-lg-6">
            {{ Field::input('text','name',null,['id' => 'name']) }}
        </div>
        <div class="input-group date">
            {{Field::input('datepicker','execute_date',null,['class'=> "datepicker", 'data-provide'=>"datepicker",'data-date-language' => "es",'data-date-start-date'=>"now()", 'data-date-format' => "dd-mm-yyyy" ])}}
        </div>

    </div>
    <div class="col-lg-12">
        {{ Field::textarea('body',$template->body, ['class' => 'ckeditor']) }}
    </div>


    <p>
        <a href="{{Route('document.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los documentos creados" data-original-title="Atras">Atras</a>
        <input type="submit" value="Crear" class="btn btn-custom-create" data-toggle="popover" data-content="Permite crear documentos" data-original-title="Crear">
    </p>


    {{Form::close()}}

@endsection