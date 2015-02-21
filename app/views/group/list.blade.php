@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <script>
        $('#confirm').click(function(event){
            event.preventDefault();
            var id = $(this).data('id');
            // console.log(id);
            // pass id to appropriate element here
            $(".modal-header #id").val(id);
        });
    </script>

    <h1 class="page-header">Grupos</h1>
    <div class="col-lg-12">
        <div class="col-lg-3"><p><a id="example" class="btn btn-custom-create" href="{{Route('group.create')}}" data-trigger="hover" data-toggle="popover" data-content="Permite crear nuevos Grupos." data-original-title="Crear Tarea">Crear Grupo</a></p></div>
        <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('groupActivation')}}" data-toggle="popover" data-content="Permite reactivar los grupos que han sido desactivados" data-original-title="Re-activar">Re-Activar</a></div>
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
                        -En esta seccion podra crear los diferentes grupos en los cuales seran incluidos los ususarios para conceder acceso a las respectivas funciones.
                        <br>
                        -Las posibles acciones sobre los grupos son:crear,desactivar,re-activar, eliminar y buscar.
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

    <h3>Se encontraron {{$groups->getTotal()}} grupos registrados.</h3>

    @include('group.filters')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($groups as $group)
            <tr>
                <td class="name">{{$group->name}}</td>
                <td>
                    <div id="yes" style="float:left; padding-right:10px">
                        {{ Form::open(['route' => ['group.edit', $group->id ], 'method' => 'GET']) }}
                        {{ Form::button('Editar', ['type' => 'submit', 'class' => 'btn btn-custom-disable','data-trigger'=>"hover", 'data-toggle'=>"popover", 'data-content'=>"Permite Editar los grupos que ya han sido creados.", 'data-original-title'=>"Editar Grupo", 'data-target'=>'#editGroup'.$group->id, 'data-id'=>$group->id]) }}
                        {{ Form::close() }}
                    </div> <!-- end yes -->
                    @if($group->stepDocuments->count() > 0)
                        <button class="btn btn-custom-disable" id="confirm{{$group->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad del grupo y no podra ser usado hasta que se habilite nuevamente." data-original-title="Desactivar grupo" href="#" data-target="#disableGroup{{$group->id}}" data-id="{{$group->id}}">Desactivar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="disableGroup{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar al Grupo: {{$group->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar activar este usuarui puede re-activarlo en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['group.destroy', $group->id ], 'method' => 'DELETE']) }}
                                                {{ Form::button('Desactivar', ['type' => 'submit', 'class' => 'btn btn-custom-disable']) }}
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
                    @else
                        <button class="btn btn-custom-delete" id="confirm{{$group->id}}" type="button" data-trigger="hover" data-toggle="popover" data-content="Elimina Fisicamente el grupo, para volver a usarlo sera necesario crearlo nuevamente." data-original-title="Eliminar Grupo" href="#" data-target="#delGroup{{$group->id}}" data-id="{{$group->id}}">Eliminar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="delGroup{{$group->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar al Grupo: {{$group->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>El usuario sera eliminado completamente del sistema</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['group.destroy', $group->id ], 'method' => 'DELETE']) }}
                                                {{ Form::button('Eliminar', ['type' => 'submit', 'class' => 'btn btn-custom-delete']) }}
                                                {{ Form::close() }}
                                            </div> <!-- end yes -->

                                            <div id="no" style="float:left;">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                            </div><!-- end no -->

                                        </div> <!-- end delmodelcontainer -->

                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    @endif
                    <script>
                        $('#confirm{{$group->id}}').click(function () {
                            if ($(this).text() == 'Desactivar') {
                                $('#disableGroup{{$group->id}}').modal('show');
                            }
                            else{
                                $('#delGroup{{$group->id}}').modal('show');
                            }
                        });

                    </script>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$groups->links()}}

@endsection
