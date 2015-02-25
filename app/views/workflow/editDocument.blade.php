@extends('layout')
@extends('navbar')
@extends('sidebar')

@section('head')
    <script>
        $(function() {
            // setting up the datepicker
            $('.input-group.date').datepicker({
                format: "dd-mm-yyyy",
                startDate: "now",
                todayBtn: "linked",
                language: "es",
                orientation: "top auto",
                autoclose: true
            });
        });
    </script>
@endsection
@section('body')

    <h1 class="page-header">Editar el Documento</h1>


    {{ Form::model($document,['route' => ['workflow.saveDocument',$document->id, $workflow->id], 'method' => 'PUT', 'role' => 'form']) }}

    <div class="form-group">
        {{Form::hidden('templates_id',null,['id' => 'templates_id'])}}
    </div>
    <div class="col-lg-12">
        <div class="col-lg-6">
            {{ Field::input('text','name',null,['id' => 'name']) }}
        </div>
        <div class="input-group date">
            {{ Field::input('datepicker','execute_date',null,['readonly']) }}
        </div>

    </div>
    <div class="col-lg-12">
        {{ Field::textarea('body',null, ['class' => 'ckeditor']) }}
    </div>


    <p>
        <a href="{{Route('workflow.action',[$document->id, $workflow->id])}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de documentos creados" data-original-title="Atras">Atras</a>
        <input type="submit" value="Editar" class="btn btn-custom-edit" data-toggle="popover" data-content="Permite editar el Documento" data-original-title="Editar">
    </p>

    {{Form::close()}}

@endsection