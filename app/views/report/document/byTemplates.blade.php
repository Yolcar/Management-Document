<div class="modal fade" id="myModalTemplate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
            </div>
            <div class="modal-body">
                <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <th><div class="bold">ID</div></th>
                    <th><div class="bold">Nombre</div></th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>0</td>
                        <td><div class="btn" onclick="fillable('byTemplate','Vacio')">Vacio</div></td>
                    </tr>
                    @foreach($templates as $template)
                        <tr>
                            <td>{{$template->id}}</td>
                            <td><div class="btn" onclick="fillable('byTemplate','{{$template->name}}')">{{$template->name}}</div></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> Cancel </button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->