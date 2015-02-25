<div class="modal fade" id="myModalTypeDocuments" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <table id="" class="display table table-striped table-bordered byTypeDocuments" cellspacing="0" width="100%">
                    <thead>
                    <th><div class="bold">Nombre</div></th>
                    </thead>
                    <tbody>
                    @foreach($typeDocuments as $typeDocument)
                        <tr>
                            <td>{{ Form::checkbox('byTypeDocuments',$typeDocument->name) }}{{$typeDocument->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="fillable('byTypeDocuments')" class="btn btn-success" data-dismiss="modal"> Aceptar </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->