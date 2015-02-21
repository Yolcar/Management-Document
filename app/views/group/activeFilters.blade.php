{{ Form::open(['route' => 'groupActivation', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Hace una búsqueda de los Grupos desactivados.','data-original-title'=>'Buscar']) }}

{{Form::close()}}