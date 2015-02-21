@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1 class="page-header">Nuevo Usuario</h1>

            {{ Form::open(['route' => 'user.store', 'method' => 'POST', 'role' => 'form']) }}

            {{Field::input('text','full_name',null)}}
            {{Field::input('text','email',null)}}
            {{Field::input('text','password',null)}}
            {{Field::input('text','password_confirmation',null,['placeholder' => 'Repita la contraseña'])}}
            <p>
                <a href="{{Route('user.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los usuarios creados" data-original-title="Atras">Atras</a>
                <input type="submit" value="Crear" class="btn btn-custom-create" data-toggle="popover" data-content="Permite crear un nuevo usuario" data-original-tittle="Crear Usuario">
            </p>

            {{Form::close()}}
        </div>
    </div>
</div>

@endsection