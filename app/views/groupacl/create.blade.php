@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')


    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 class="page-header">Nuevo Grupo Funcional</h1>

                {{ Form::open(['route' => 'groupacl.store', 'method' => 'POST', 'role' => 'form']) }}

                {{Field::input('text','name',null)}}
                <p>
                    <input type="submit" value="Crear" class="btn btn-custom-create">
                </p>

                {{Form::close()}}
            </div>
        </div>
    </div>


@endsection