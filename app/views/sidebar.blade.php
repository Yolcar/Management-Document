@section('sidebar')
<div class="col-xs-7 col-sm-3 col-md-2 sidebar sidebar-left sidebar-animate sidebar-md-show sidebar-inverse">
    <ul class="nav navbar-stacked">
        <li class="active"><a href="{{ route('home') }}">Home</a></li>
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Tareas'))
                <li><a href="{{ route('task.index') }}">Tareas</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Tipos de Documentos'))
                <li><a href="{{ route('type_document.index') }}">Tipos de Documentos</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Plantillas'))
                <li><a href="{{ route('template.index') }}">Plantillas</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Documentos'))
                <li><a href="{{ route('document.index') }}">Documentos</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Reportes'))
                <li><a href="{{ route('report.index') }}">Reportes</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Usuarios'))
                <li><a href="{{ route('user.index') }}">Usuarios</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Grupos'))
                <li><a href="{{ route('group.index') }}">Grupos de Trabajo</a></li>
                <?php break ?>
            @endif
        @endforeach
        @foreach(Auth::getUser()->groupacls as $gruposacls)
            @if($gruposacls->hasModule('Grupos Funcionales'))
                <li><a href="{{ route('groupacl.index') }}">Grupos Funcionales</a></li>
                <?php break ?>
            @endif
        @endforeach
    </ul>
</div>
@endsection