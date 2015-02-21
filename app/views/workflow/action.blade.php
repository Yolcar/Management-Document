@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::model($document,['route' => ['workflow.update',$document->id,$workflow->id], 'method' => 'POST', 'role' => 'form']) }}

    <div class="form-group text-center">
        <h1>Informacion del documento</h1>
        <h1 class="page-header">{{$document->name}}</h1>
        <br>
        <div class="col-lg-12">
            {{$document->body}}
            <br>
            <br>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="col-lg-4"><a class="btn btn-custom-back" href="{{ Route('workflow.show', $document->id) }}"data-toggle="popover" data-content="Permite volver a la lista de flujo del documento" data-original-title="Atras">Atras</a></div>
        <div class="col-lg-1"></div>
        <div class="col-lg-4"><input class="btn btn-custom-create" type="submit" name="confirm" value="Aceptar" data-toggle="popover" data-content="Permite confirmar el paso actual del documento" data-original-title="Aceptar"></div>
        <div class="col-lg-2"></div>
        <div class="col-lg-3"><input class="btn btn-custom-delete" type="submit" name="deny" value="Rechazar"data-toggle="popover" data-content="Permite cancelar la realizacion del documento" data-original-title="Rechazar"></div>
    </div>

    {{Form::close()}}

@endsection
