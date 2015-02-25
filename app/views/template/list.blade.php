@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

    <h1 class="page-header">Plantillas</h1>

    <div class="col-lg-12">
        <div class="col-lg-3"><p><a id="example" class="btn btn-custom-create"  href="{{Route('template.create')}}" data-toggle="popover" data-content="Permite crear una nueva plantilla." data-original-title="Crear Tarea">Crear Plantillas</a></p></div>

        <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('templateActivation')}}" data-toggle="popover" data-content="Permite reactivar las plantillas que han sido desactivadas" data-original-title="Re-activar">Re-Activar</a></div>
        <div class="col-lg-5"></div>
        <div class="col-lg-1"><a class="btn btn-custom-active" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-sign"></span> <strong>Ayuda</strong></a></div>
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ayuda</h4>
                    </div>
                    <div class="modal-body">
                        -En esta seccion podra crear las diferentes plantillas que se usaran para la elaboracion del documento.
                        <br>
                        -Las posibles acciones sobre las plantillas son:crear,desactivar,re-activar, eliminar y buscar.
                        <br>
                        -Las especificaciones las encontraras colocando el puntero sobre cada boton.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>
    <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="20%">Tipo Documento</th>
                <th width="40%">Nombre</th>
                <th width="40%">Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($templates as $template)
            <tr>
                <td>{{$template->typedocuments->name}}</td>
                <td class="name">{{$template->name}}</td>
                <td>
                    <a class="btn btn-custom-step" href="{{ Route('steps', $template->id) }}" data-toggle="popover" data-content="Permite asignar los pasos que son parte del flujo de un Documento." data-original-title="Asignar Pasos "> Asignar Pasos </a>
                    <a class="btn btn-custom-show" href="{{ Route('template.show', $template->id) }}"data-toggle="popover" data-content="Permite mostrar la informacion de la plantilla creada." data-original-title="Mostrar" > Mostrar </a>
                    <a class="btn btn-custom-edit" href="{{Route('template.edit', $template->id)}}" data-toggle="popover" data-content="Permite editar la plantilla creada." data-original-title="Editar"> Editar</a>

                    @if($template->document->count() > 0)
                        <button class="btn btn-custom-disable" id="confirm{{$template->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad de esta plantilla y no podra se usada hasta que se habilite nuevamente." data-original-title="Desactivar plantilla" href="#" data-target="#disableTemplate{{$template->id}}" data-id="{{$template->id}}">Desactivar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="disableTemplate{{$template->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar la plantilla: {{$template->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente esta plantilla puede re-activarla en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['template.destroy', $template->id ], 'method' => 'DELETE']) }}
                                                {{ Form::button('Si', ['type' => 'submit', 'class' => 'btn btn-custom-disable']) }}
                                                {{ Form::close() }}
                                            </div> <!-- end yes -->

                                            <div id="no" style="float:left;">
                                                <button type="button" class="btn btn-custom-delete" data-dismiss="modal">No</button>
                                            </div><!-- end no -->

                                        </div> <!-- end delmodelcontainer -->

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                        <!-- Modal -->
                    @else
                        <button class="btn btn-custom-delete" id="confirm{{$template->id}}" type="button" data-trigger="hover" data-toggle="popover" data-content="Elimina Fisicamente esta plantilla, para volver a usarla sera necesario crearla de nuevo." data-original-title="Eliminar Plantilla" href="#" data-target="#delTemplate{{$template->id}}" data-id="{{$template->id}}">Eliminar</button>

                        <!-- /.modal -->
                        <div class="modal fade" id="delTemplate{{$template->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar la plantilla: {{$template->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente esta plantilla en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['template.destroy', $template->id ], 'method' => 'DELETE']) }}
                                                {{ Form::button('Si', ['type' => 'submit', 'class' => 'btn btn-custom-delete']) }}
                                                {{ Form::close() }}
                                            </div> <!-- end yes -->

                                            <div id="no" style="float:left;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div><!-- end no -->

                                        </div> <!-- end delmodelcontainer -->

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div>
                        <!-- /.modal -->
                    @endif
                    <script>
                        $('#confirm{{$template->id}}').click(function () {
                            if ($(this).text() == 'Desactivar') {
                                $('#disableTemplate{{$template->id}}').modal('show');
                            }
                            else{
                                $('#delTemplate{{$template->id}}').modal('show');
                            }
                        });
                    </script>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$templates->links()}}
@endsection
