@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    <script>
        function asignarID(id,name){
            document.getElementById("typedocuments_id").value = id;
            document.getElementById("name").value = name;
            document.getElementById("my-btn").click();
        }
    </script>
@endsection

@section('body')

<h1 class="page-header">Nueva Plantilla</h1>

@include('template.typeDocumentfilters')
<br>

{{ Form::open(['route' => 'template.store', 'method' => 'POST', 'role' => 'form']) }}

    <div class="form-group">
        {{ Field::input('hidden','typedocuments_id',null,['id' => 'typedocuments_id']) }}
    </div>

    {{ Field::input('text','name',"",['id' => 'name']) }}
    {{ Field::textarea('body','', ['class' => 'ckeditor']) }}

<p>
    <a href="{{Route('template.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite volver a la lista de las plantillas creadas" data-original-title="Atras">Atras</a>
    <input type="submit" value="Crear" class="btn btn-custom-create " data-toggle="popover" data-content="Permite crear la Plantilla." data-original-title="Crear Plantilla">
</p>

{{Form::close()}}

@endsection