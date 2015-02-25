<div class="modal fade" id="myModalGroups" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <table id="" class="display table table-striped table-bordered byGroups" cellspacing="0" width="100%">
                    <thead>
                    <th><div class="bold">Nombre</div></th>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ Form::checkbox('byGroups',$group->name) }}{{$group->name}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" onclick="fillable('byGroups')" class="btn btn-success" data-dismiss="modal"> Aceptar </button>
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->