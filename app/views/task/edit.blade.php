@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Editar Tarea</h1>

    {{ Form::model($task,['route' => ['task.update',$task->id], 'method' => 'PUT', 'role' => 'form']) }}

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
        <input type="submit" value="Modificar" class="btn btn-custom-edit">
    </p>

    {{Form::close()}}

@endsection
