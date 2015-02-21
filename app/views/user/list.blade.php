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

    <h1 class="page-header">Usuarios</h1>
    <div class="col-lg-12">
        <div class="col-lg-3"><p><a class="btn btn-custom-create" href="{{Route('user.create')}}" data-toggle="popover" data-content="Permite registrar nuevos usuarios." data-original-title="Registrar Nuevo Usuario">Registrar Nuevo Usuario</a></p></div>
         <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('userActivation')}}" data-toggle="popover" data-content="Permite reactivar los usuarios que han sido desactivados" data-original-title="Re-activar">Re-Activar</a></div>
    </div>


    <h3>Se encontraron {{$users->getTotal()}} usuarios registrados.</h3>

    @include('user.filters')

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo Electronico</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="name">{{$user->full_name}}</td>
                <td class="email">{{$user->email}}</td>
                <td>
                    <div id="yes" style="float:left; padding-right:10px">
                        {{ Form::open(['route' => ['user.edit', $user->id ], 'method' => 'GET']) }}
                        {{ Form::button('Administrar', ['type' => 'submit', 'class' => 'btn btn-custom-disable','data-toggle'=>'popover','data-content'=>'Permite editar la informacion de los  usuarios ya creados.','data-original-title'=>'Administrar']) }}
                        {{ Form::close() }}
                    </div> <!-- end yes -->
                    @if($user->workflow->count()>0)
                        <button class="btn btn-custom-disable" id="confirm{{$user->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad del usuario y no podra se usado hasta que se habilite nuevamente." data-original-title="Desactivar plantilla" href="#" data-target="#disableUser{{$user->id}}" data-id="{{$user->id}}">Desactivar</button>

                        <!-- Modal -->
                        <div class="modal fade" id="disableUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar al usuario: {{$user->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar activar este usuario puede re-activarlo en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['user.destroy', $user->id ], 'method' => 'DELETE']) }}
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
                        <button class="btn btn-custom-delete" id="confirm{{$user->id}}" type="button" data-trigger="hover" data-toggle="popover" data-content="Elimina Fisicamente el usuario, para volver a usarlo sera necesario crearlo de nuevo." data-original-title="Eliminar Usuario" href="#" data-target="#delUser{{$user->id}}" data-id="{{$user->id}}">Eliminar</button>

                        <!-- Modal -->
                        <div class="modal fade" id="delUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar al usuario: {{$user->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>El usuario sera eliminado completamente del sistema</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['user.destroy', $user->id ], 'method' => 'DELETE']) }}
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
                        $('#confirm{{$user->id}}').click(function () {
                            if ($(this).text() == 'Desactivar') {
                                $('#disableUser{{$user->id}}').modal('show');
                            }
                            else{
                                $('#delUser{{$user->id}}').modal('show');
                            }
                        });
                    </script>
                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$users->links()}}

@endsection
