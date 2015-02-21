{{ Form::open(['route' => 'document.index', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle' => 'popover', 'data-content'=>'Hace una búsqueda de los documentos creados.','data-original-title'=>'Buscar']) }}

{{Form::close()}}