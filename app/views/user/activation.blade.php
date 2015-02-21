@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Usuarios Desactivadas</h1>

    <h3>Se encontraron {{$users->getTotal()}} usuarios desactivados.</h3>

    @include('user.activeFilters')

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="40%">Nombre</th>
            <th width="40%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="name">{{$user->full_name}}</td>
                <td>
                    {{ Form::open(['route' => ['userActive',$user->id], 'method' => 'POST','role' => 'form']) }}
                    {{ Form::button('Activar', ['type' => 'submit', 'class' => 'btn btn-custom-active','data-toggle'=>'popover','data-content'=>'Permite activar los usuarios que fueron desactivados','data-original-title'=>'Activar']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}
    <a href="{{Route('user.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los usuarios ya  creados" data-original-title="Atras">Atras</a>
@endsection
