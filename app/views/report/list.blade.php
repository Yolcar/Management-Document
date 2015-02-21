@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')

    <h1 class="page-header">Reportes</h1>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <a href=""> <div class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-user"></i> <span class="text-large margin-left-15">{{$total_users->count()}}</span>
            <br/>Usuarios Registrados
        </div>
        </a>
        <div class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-th-large"></i> <span class="text-large margin-left-15">{{$total_tasks->count()}}</span>
            <br/>Tareas Registradas
        </div>
        <a href="{{Route('report.getDocuments')}}"><div onclick="" class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-file"></i> <span class="text-large margin-left-15">{{$total_documents->count()}}</span>
            <br/>Total de Documentos</div>
        </a>
        <div class="stats-item margin-left-5 margin-bottom-12"><i class="fa fa-file-text"></i> <span class="text-large margin-left-15">{{$total_templates->count()}}</span>
            <br/>Total de Plantillas
        </div>
        <div class="stats-item margin-left-5 margin-bottom-12"><i class="fa fa-users"></i> <span class="text-large margin-left-15">{{$total_groups->count()}}</span>
            <br/>Total de Grupos
        </div>
        <div class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-list-alt"></i> <span class="text-large margin-left-15">{{$total_typeDocuments->count()}}</span>
            <br/>Total Tipos de Documentos
        </div>
    </div>
@endsection
