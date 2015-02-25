@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

    <h1 class="page-header">Grupos Funcionales</h1>

    <div class="col-lg-12">
        <div class="col-lg-3"><p><a id="example" class="btn btn-custom-create" href="{{Route('groupacl.create')}}" data-trigger="hover" data-toggle="popover" data-content="Permite crear nuevos Grupos funcionales" data-original-title="Crear Grupo Funcional">Crear Grupo Funcional</a></p></div>
        <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('groupacl.activation')}}" data-toggle="popover" data-content="Permite reactivar los grupos que han sido desactivados" data-original-title="Re-activar">Re-Activar</a></div>
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

    <br><br><br>
    <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        @foreach($groupacls as $groupacl)
            <tr>
                <td class="name">{{$groupacl->name}}</td>
                <td>
                    <div id="yes" style="float:left; padding-right:10px">
                        {{ Form::open(['route' => ['groupacl.edit', $groupacl->id ], 'method' => 'GET']) }}
                        {{ Form::button('Administrar', ['type' => 'submit', 'class' => 'btn btn-custom-disable','data-trigger'=>"hover", 'data-toggle'=>"popover", 'data-content'=>"Permite Editar los grupos que ya han sido creados.", 'data-original-title'=>"Editar Grupo", 'data-target'=>'#editGroup'.$groupacl->id, 'data-id'=>$groupacl->id]) }}
                        {{ Form::close() }}
                    </div> <!-- end yes -->
                    @if($groupacl->id!=1)
                        @if($groupacl->user->count() > 0)
                            <button class="btn btn-custom-disable" id="confirm{{$groupacl->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad del grupo y no podra ser usado hasta que se habilite nuevamente." data-original-title="Desactivar grupo" href="#" data-target="#disableGroup{{$groupacl->id}}" data-id="{{$groupacl->id}}">Desactivar</button>
                            <!-- Modal -->
                            <div class="modal fade" id="disableGroup{{$groupacl->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar al Grupo: {{$groupacl->name}}?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar activar este usuarui puede re-activarlo en un futuro</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="delmodelcontainer" style="float:right">

                                                <div id="yes" style="float:left; padding-right:10px">
                                                    {{ Form::open(['route' => ['groupacl.destroy', $groupacl->id ], 'method' => 'DELETE']) }}
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
                            <button class="btn btn-custom-delete" id="confirm{{$groupacl->id}}" type="button" data-trigger="hover" data-toggle="popover" data-content="Elimina Fisicamente el grupo, para volver a usarlo sera necesario crearlo nuevamente." data-original-title="Eliminar Grupo" href="#" data-target="#delGroup{{$groupacl->id}}" data-id="{{$groupacl->id}}">Eliminar</button>
                            <!-- Modal -->
                            <div class="modal fade" id="delGroup{{$groupacl->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar al Grupo: {{$groupacl->name}}?</h4>
                                        </div>
                                        <div class="modal-body">
                                            <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>El usuario sera eliminado completamente del sistema</h4>
                                        </div>
                                        <div class="modal-footer">
                                            <div id="delmodelcontainer" style="float:right">

                                                <div id="yes" style="float:left; padding-right:10px">
                                                    {{ Form::open(['route' => ['groupacl.destroy', $groupacl->id ], 'method' => 'DELETE']) }}
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
                    @endif
                    <script>
                        $('#confirm{{$groupacl->id}}').click(function () {
                            if ($(this).text() == 'Desactivar') {
                                $('#disableGroup{{$groupacl->id}}').modal('show');
                            }
                            else{
                                $('#delGroup{{$groupacl->id}}').modal('show');
                            }
                        });

                    </script>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>


    {{$groupacls->links()}}

@endsection