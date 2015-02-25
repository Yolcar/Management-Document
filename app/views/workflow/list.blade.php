@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
	<div class="col-md-8">
		<h1 class="page-header">Tracking</h1>

        <br><br><br>
        <table id="" class="display table table-striped table-bordered" cellspacing="0" width="100%">
				<thead>
				<tr>
					<th>Tipo de Documento</th>
					<th>Nombre</th>
					<th>Fecha Creacion</th>
					<th>Acciones</th>
				</tr>
				</thead>
				<tbody>
				@foreach($documents as $document)
					<tr>
						<td>{{$document->template->name}}</td>
						<td>{{$document->name}}</td>
						<td>{{$document->created_at}}</td>
						<td>
							<a href="{{Route('workflow.show',$document->id)}}" class="btn btn-info" data-toggle="popover" data-content="Abre una ventana que mostrara la información del Documento y actividades a realizarle." data-original-title="Ver Tracking">Ver Tracking</a>
						</td>
					</tr>
				@endforeach
				</tbody>
        </table>
    </div>

@endsection