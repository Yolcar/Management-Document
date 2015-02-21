@section('sidebar')
<div class="col-xs-7 col-sm-3 col-md-2 sidebar sidebar-left sidebar-animate sidebar-md-show sidebar-inverse">
    <ul class="nav navbar-stacked">
        <li class="active"><a href="{{ route('home') }}">Home</a></li>
        {{--Usuarios Basico--}}
        <li><a href="{{ route('document.index') }}">Documentos</a></li>
        @if(Auth::getUser()->hasGroup(Config::get('custom.group_management.name')))
            {{--Usuario Manager--}}
            <li><a href="{{ route('task.index') }}">Tareas</a></li>
            <li><a href="{{ route('template.index') }}">Plantillas</a></li>
            <li><a href="{{ route('type_document.index') }}">Tipo de Documento</a></li>
            <li><a href="{{ route('user.index') }}">Usuarios</a></li>
            <li><a href="{{ route('group.index') }}">Grupos</a></li>
            <li><a href="{{ route('report.index') }}">Reportes</a></li>
        @endif
    </ul>
</div>
@endsection