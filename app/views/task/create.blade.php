@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-header">Nueva Tarea</h1>

            {{ Form::open(['route' => 'task.store', 'method' => 'POST', 'role' => 'form']) }}

            {{ Field::input('text','name') }}

            <p>
                <a href="{{Route('task.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de las tareas creadas" data-original-title="Atras">Atras</a>
                <input type="submit" value="Crear" class="btn btn-custom-create" data-toggle="popover" data-content="Permite crear una nueva tarea" data-original-tittle="Crear" >
            </p>

            {{Form::close()}}
        </div>
    </div>
</div>

@endsection