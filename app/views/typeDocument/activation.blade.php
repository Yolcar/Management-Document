@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Tipos de Documentos Desactivados</h1>

    <h3>Se encontraron {{$typedocuments->getTotal()}} tipos de documentos desactivados.</h3>

    @include('typeDocument.activeFilters')

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th width="40%">Nombre</th>
            <th width="40%">Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($typedocuments as $typedocument)
            <tr>
                <td class="name">{{$typedocument->name}}</td>
                <td>
                    {{ Form::open(['route' => ['typedocumentActive',$typedocument->id], 'method' => 'POST','role' => 'form']) }}
                    {{ Form::button('Activar', ['type' => 'submit', 'class' => 'btn btn-custom-active','data-toggle'=>'popover','data-content'=>'Permite activar los tipos de documentos que fueron desactivados','data-original-title'=>'Activar']) }}
                    {{ Form::close() }}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$typedocuments->links()}}
    <a href="{{Route('type_document.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de los tipos de documentos creados" data-original-title="Atras">Atras</a>
@endsection
