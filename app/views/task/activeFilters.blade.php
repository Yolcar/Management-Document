{{ Form::open(['route' => 'taskActivation', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Hace una búsqueda de las tareas desactivadas.','data-original-title'=>'Buscar']) }}

{{Form::close()}}