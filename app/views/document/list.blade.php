@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <h1 class="page-header">Documentos</h1>
    <div class="col-lg-12">
        <div class="col-lg-1"><p> <a class="btn btn-custom-create" href="{{ Route('document.create') }}" data-toggle="popover" data-content="Permite crear nuevos documentos." data-original-title="Crear Documento">Crear Documento</a></p></div>
        <div class="col-lg-10"></div>
        <div class="col-lg-1"><p> <a class="btn btn-custom-active" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-question-sign"></span> <strong>Ayuda</strong></a></p></div>
</div>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Ayuda</h4>
                </div>
                <div class="modal-body">
                    -En esta seccion podra crear los diferentes documentos que se manejan en la empresa.
                    <br>
                    -Las posibles acciones sobre los documentos son:crear, mostrar, editar, ver tracking y buscar.
                    <br>
                    -Las especificaciones las encontraras colocando el puntero sobre cada boton.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <br><br><br>
        <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Serial</th>
                <th>Nombre</th>
                <th>Tipo Plantilla</th>
                <th>Fecha de Creacion</th>
                <th>Fecha de Ejecucion</th>
                <th width="30%">Acciones</th>
            </tr>
            </thead>

            <tfoot>
            <tr>
                <th>Serial</th>
                <th>Nombre</th>
                <th>Tipo Plantilla</th>
                <th>Fecha de Creacion</th>
                <th>Fecha de Ejecucion</th>
                <th width="30%">Acciones</th>
            </tr>
            </tfoot>
            <tbody>
            @foreach($documents as $document)
                <tr>
                    <td>{{$document->serial}}</td>
                    <td class="name">{{$document->name}}</td>
                    <td>{{$document->template->name}}</td>
                    <td>{{$document->created_at}}</td>
                    <td>{{$document->execute_date}}</td>

                    <td>
                        {{ Form::open(['route' => ['document.destroy', $document->id ], 'method' => 'DELETE']) }}
                        @if($document->workflow->first()->users_id == Auth::getUser()->id)
                            @if($document->workflow->count() > 1)
                                @if($document->workflow->find($document->workflow->first()->id+1)->users_id == 0)
                                    <a class="btn btn-custom-edit" href="{{Route('document.edit', $document->id)}}" data-toggle="popover" data-content="Permite editar los documentos creados de la lista" data-original-title="Editar">Editar</a>
                                @endif
                            @else
                                <a class="btn btn-custom-edit" href="{{Route('document.edit', $document->id)}}" data-toggle="popover" data-content="Permite editar los documentos creados de la lista" data-original-title="Editar">Editar</a>
                            @endif
                            <script>
                                $('#confirm{{$document->id}}').click(function () {
                                    if ($(this).text() == 'Desactivar') {
                                        $('#disableDocument{{$document->id}}').modal('show');
                                    }
                                    else{
                                        $('#delDocument{{$document->id}}').modal('show');
                                    }
                                });
                            </script>
                        @endif
                        <a class="btn btn-custom-show" href="{{Route('document.show', $document->id)}}" data-toggle="popover" data-content="Da una vista previa del documento seleccionado." data-original-title="Mostrar">Mostrar</a>
                        <a href="{{Route('workflow.show',$document->id)}}" class="btn btn-custom-tracking" data-toggle="popover" data-content="Abre una ventana que mostrara la información del Documento y actividades a realizarle." data-original-title="Ver Tracking">Ver Tracking</a>
                    </td>

                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection
