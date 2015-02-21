{{ Form::open(['route' => 'user.index', 'method' => 'GET']) }}

    {{ Form::text('search') }}
    {{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Permite hacer una busqueda de los usuarios en la Lista.','data-original-title'=>'Buscar']) }}

{{Form::close()}}