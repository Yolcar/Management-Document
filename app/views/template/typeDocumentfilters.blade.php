
<h3>Seleccione el Tipo de Documento</h3>
<div class="span4"><button id="my-btn" type="button" data-trigger="hover" class="btn btn-custom-show " data-original-title="Mostrar" data-content="Muestra la lista del Tipo de documento que va a seleccionar" data-toggle="popover">Mostrar</button></div>



<script>

    $('#my-btn').click(function () {
        if ($(this).text() == 'Mostrar'){
            $('#myDiv').collapse('show');
            $('#my-btn').html('Ocultar');
        }else{
            $('#myDiv').collapse('hide');
            $('#my-btn').html('Mostrar');
        }
    });


</script>

<div class="span4 collapse" id="myDiv">
{{ Form::open(['route' => 'template.create', 'method' => 'GET']) }}

{{ Form::text('search') }}
{{ Form::button('Buscar',['type' => 'submit', 'class' => 'btn btn-custom-search','data-toggle'=>'popover','data-content'=>'Hace una búsqueda de los tipos de documentos creados.','data-original-title'=>'Buscar']) }}

{{Form::close()}}
<table class="table table-striped table-hover">
    <div>
    <thead>
    </thead>
    <tbody>
    @foreach($typeDocuments as $typeDocument)
        <tr>
            <td class="name">{{$typeDocument->name}}</td>
            <td>
                <button onclick="asignarID('{{$typeDocument->id}}','{{$typeDocument->name}}')" type="button" class="btn btn-custom-step" data-toggle="popover" data-content="Selecciona el tipo de documento que va a pertenecer la plantilla." data-original-title="Usar Tipo">Usar Tipo</button>
            </td>
        </tr>
    @endforeach
    </tbody>
    </div>
</table>
{{$typeDocuments->links()}}
</div>
