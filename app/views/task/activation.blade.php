@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Tareas Desactivadas</h1>

    <h3>Se encontraron {{$tasks->getTotal()}} tareas desactivadas.</h3>

    @include('task.activeFilters')

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="40%">Nombre</th>
            <th width="40%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($tasks as $task)
            <tr>
                <td class="name">{{$task->name}}</td>
                <td>
                    {{ Form::open(['route' => ['taskActive',$task->id], 'method' => 'POST','role' => 'form']) }}
                    {{ Form::button('Activar', ['type' => 'submit', 'class' => 'btn btn-custom-active','data-toggle'=>'popover','data-content'=>'Permite activar las tareas que fueron desactivadas','data-original-title'=>'Activar']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$tasks->links()}}
    <a href="{{Route('task.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de las tareas creadas" data-original-title="Atras">Atras</a>
@endsection
