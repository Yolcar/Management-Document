{{ Form::open(['route' => 'task.index', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Permite hacer una busqueda de las tareas en la Lista.','data-original-title'=>'Buscar']) }}

{{Form::close()}}