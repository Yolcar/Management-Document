{{ Form::open(['route' => 'template.index', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Hace una búsqueda en la lista de las Plantillas creadas.','data-original-title'=>'Buscar']) }}

{{Form::close()}}