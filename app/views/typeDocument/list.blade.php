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

    <h1 class="page-header">Tipos de Documentos</h1>
<p>
    <div class="col-lg-12">
    <div class="col-lg-3"> <a class="btn btn-custom-create" href="{{Route('type_document.create')}}" data-toggle="popover" data-content="Permite crear nuevos tipos de documentos" data-original-title="Crear Tipo">Crear Tipo</a></div>
    <div class="col-lg-3"><a class="btn btn-custom-active" href="{{Route('typedocumentActivation')}}" data-toggle="popover" data-content="Permite reactivar los documentos  que han sido desactivados" data-original-title="Re-activar">Re-Activar</a></div>
     <div class="col-lg-5"> </div>
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
                        -En esta seccion podra crear los tipos de documentos que identificaran a las plantillas.
                        <br>
                        -Las posibles acciones sobre los tipos de documentos son:crear, desactivar, re-activar, eliminar y buscar.
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
</p>

    <br><br><br>
    <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @foreach($typeDocuments as $typeDocument)
            <tr>
                <td width="70%" class="name">{{$typeDocument->name}}</td>
                <td>
                    @if($typeDocument-> template -> count()> 0)
                        <button class="btn btn-custom-disable" id="confirm{{$typeDocument->id}}" data-trigger="hover" data-toggle="popover" data-content="Cambia la disponibilidad del Tipo de Documento y no podra se usada hasta que se habilite nuevamente." data-original-title="Desactivar Tipo Documento" href="#" data-target="#disableTypeDocument{{$typeDocument->id}}" data-id="{{$typeDocument->id}}">Desactivar</button>
                        <!-- Modal -->
                        <div class="modal fade" id="disableTypeDocument{{$typeDocument->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de desactivar el tipo de documento?: {{$typeDocument->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente este Tipo de Documento puede re-activarlo en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['type_document.destroy', $typeDocument->id ], 'method' => 'DELETE']) }}
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
                        <button id="confirm{{$typeDocument->id}}" type="button" data-trigger="hover"  class="btn btn-custom-delete"   data-toggle="popover" data-content="Elimina Fisicamente este Tipo de Documento, para volver a usarla sera necesario crearla de nuevo." data-original-title="Eliminar Tipo Documento" href="#" data-target="#delTypeDocument{{$typeDocument->id}}" data-id="{{$typeDocument->id}}">Eliminar</button>

                        <!-- /.modal -->
                        <div class="modal fade" id="delTypeDocument{{$typeDocument->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="myModalLabel">¿Estas seguro de Eliminar el Tipo de Documento: {{$typeDocument->name}}?</h4>
                                    </div>
                                    <div class="modal-body">
                                        <h4 class="modal-title" id="myModalLabel"><span style="color:red;" class="glyphicon glyphicon-warning-sign"></span> <p id="id"></p>Si necesita usar nuevamente este Tipo de Documento en un futuro</h4>
                                    </div>
                                    <div class="modal-footer">
                                        <div id="delmodelcontainer" style="float:right">

                                            <div id="yes" style="float:left; padding-right:10px">
                                                {{ Form::open(['route' => ['type_document.destroy', $typeDocument->id ], 'method' => 'DELETE']) }}
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
                        $('#confirm{{$typeDocument->id}}').click(function () {
                            if ($(this).text() == 'Desactivar') {
                                $('#disableTypeDocument{{$typeDocument->id}}').modal('show');
                            }
                            else{
                                $('#delTypeDocument{{$typeDocument->id}}').modal('show');
                            }
                        });

                    </script>

                </td>

            </tr>
        @endforeach
        </tbody>
    </table>
    {{$typeDocuments->links()}}
@endsection
