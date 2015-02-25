@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

    <h1 class="page-header">Tareas</h1>
    <div class="col-lg-12">
        <div class="col-lg-3"><p><a id="example" class="btn btn-custom-create" href="{{Route('task.create')}}" data-trigger="hover" data-toggle="popover" data-content="Permite crear nuevas tareas que forman parte del flujo de un Documento." data-original-title="Crear Tarea">Crear Tarea</a></p></div>
        <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('taskActivation')}}" data-toggle="popover" data-content="Permite reactivar las tareas que han sido desactivadas" data-original-title="Re-activar">Re-Activar</a></div>
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
                        -En esta seccion podra crear las diferentes tareas que se usaran en cada uno de los pasos del flujo de trabajo de los documentos.
                        <br>
                        -Las posibles acciones sobre las tareas son:crear,desactivar,re-activar, eliminar y buscar.
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
        @foreach($tasks as $task)
            <tr>
                <td class="name">{{$task->name}}</td>
                <td>
                    @if($task->stepDocument->count()>0)
                        <button class="btn btn-custom-disable" id="confirm{{$task->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad de esta tarea y no podra se usada hasta que se habilite nuevamente." data-original-title="Desactivar tareas" href="#" data-target="#disableTask{{$task->id}}" data-id="{{$task->id}}">Desactivar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="disableTask{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar la tarea: {{$task->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente esta tarea puede re-activarla en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">

                                            {{ Form::open(['route' => ['task.destroy', $task->id ], 'method' => 'DELETE']) }}
                                            {{ Form::button('Si', ['type' => 'submit', 'class' => 'btn btn-custom-disable']) }}
                                            {{ Form::close() }}
                                            </div>

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
                        <button id="confirm{{$task->id}}" type="button" data-trigger="hover"  class="btn btn-custom-delete"   data-toggle="popover" data-content="Elimina Fisicamente esta tarea, para volver a usarla sera necesario crearla de nuevo." data-original-title="Eliminar Tarea" href="#" data-target="#delTask{{$task->id}}" data-id="{{$task->id}}">Eliminar</button>

                        <!-- /.modal -->
                        <div class="modal fade" id="delTask{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar la tarea: {{$task->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente esta tarea en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['task.destroy', $task->id ], 'method' => 'DELETE']) }}
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
                            $('#confirm{{$task->id}}').click(function () {
                                if ($(this).text() == 'Desactivar') {
                                    $('#disableTask{{$task->id}}').modal('show');
                                }
                                else{
                                    $('#delTask{{$task->id}}').modal('show');
                                }
                            });

                        </script>
                </td>
            </tr>
        @endforeach
        </tbody>



    </table>

    {{$tasks->links()}}

@endsection
