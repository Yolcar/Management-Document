@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    {{ HTML::script('ckeditor/ckeditor.js') }}
@endsection

@section('body')
    {{ Form::open(['route' => ['stepsSave'], 'method' => 'POST', 'role' => 'form']) }}

    <h1 class="page-header">Asignacion de pasos para {{$template->name}}</h1>

    <div class="form-group">
        {{ Form::hidden('templates_id',$template->id) }}
    </div>

    <div class="panel panel-default">
        <!-- Default panel contents -->
        <div class="panel-heading">Pasos Actuales</div>

        <!-- Table -->
        <table class="table">
            <tr>
                <th>Paso</th>
                <th>Grupo Responsable</th>
                <th>Nivel de Prioridad</th>
            </tr>
            @foreach($stepDocuments as $stepDocument)
                <tr>
                    <td>{{$stepDocument->task->name}}</td>
                    <td>{{$stepDocument->group->name}}</td>
                    <td>{{$stepDocument->order}}</td>
                </tr>
            @endforeach
        </table>
    </div>

    <table class="table table-striped table-hover text-center">
        <thead>
        <tr>
            <th width="20%" class="text-center">Paso</th>
            <th width="40%" class="text-center">Grupo Responsable</th>
            <th width="10%" class="text-center">Nivel de Prioridad</th>
            <th width="10%" class="text-center">Editable</th>
        </tr>
        </thead>
        <tbody>
            @foreach($steps as $step)
            <tr>
                <td>{{Form::label('tasks_id',$step->name),Form::hidden('tasks_id[]',$step->id)}}</td>
                <td>
                    {{Field::select('groups_id[]',$groups)}}
                </td>
                <td>
                    @if($step->name == 'Crear')
                    {{Form::text('order[]',1,['readonly'])}}
                    @else
                    {{Field::select('order[]',$totalSteps)}}
                    @endif
                </td>
                <td>
                    @if($step->name != 'Crear')
                        {{Form::checkbox('edit['.$step->id.']',1)}}
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <p>
        <a href="{{Route('template.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina anterior de lista de plantillas" data-original-title="Atras" >Atras</a>
        <input type="submit" value="Asignar Pasos" class="btn btn-custom-create" data-toggle="popover" data-content="Permite asignar los pasos a la Plantilla" data-original-title="Asignar">
    </p>
    {{Form::close()}}

@endsection
