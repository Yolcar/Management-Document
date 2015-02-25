@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Grupos Funcionales Desactivados</h1>

    <br><br><br>
    <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th width="40%">Nombre</th>
            <th width="40%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groupacls as $groupacl)
            <tr>
                <td class="name">{{$groupacl->name}}</td>
                <td>
                    {{ Form::open(['route' => ['groupaclActive',$groupacl->id], 'method' => 'POST','role' => 'form']) }}
                    {{ Form::button('Activar', ['type' => 'submit', 'class' => 'btn btn-custom-active','data-toggle'=>'popover','data-content'=>'Permite activar los grupos que fueron desactivadas','data-original-title'=>'Activar']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$groupacls->links()}}
    <a href="{{Route('groupacl.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los grupos creados" data-original-title="Atras">Atras</a>
@endsection
