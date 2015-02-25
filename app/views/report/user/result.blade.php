@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('head')
    <script>

        $(function() {
            var completeDiv = $('.print').clone(true);
            alert(string(completeDiv));
        });

    </script>
@endsection

@section('body')
    <h1 class="page-header">Reportes Usuarios</h1>
    <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <th><div class="bold">Serial</div></th>
        @foreach($campos as $campo)
            <th><div class="bold">{{$campo['name']}}</div></th>
        @endforeach
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                @foreach($campos as $campo)
                    @if($campo['name'] == 'Grupos')
                        <td>
                            <?php $grupos = explode('|',$Groups) ?>
                            @for($i = 0; $i < count($grupos); $i++)
                            @if($user->hasGroup($grupos[$i]))
                                    - {{$grupos[$i]}}<br>
                                @endif
                            @endfor
                        </td>
                    @elseif($campo['name'] == 'Estado')
                        @if($user->available == 0)
                            <td>Desactivado</td>
                        @else
                            <td>Disponible</td>
                        @endif
                    @elseif($campo['relacion2']=='')
                        <td>{{$user->$campo['relacion1']}}</td>
                    @elseif($campo['relacion2'] == 'last')
                        <td>{{$user->$campo['relacion1']->last()->$campo['relacion3']->$campo['relacion4']}}</td>
                    @elseif($campo['relacion2']== 'first')
                        <td>{{$user->$campo['relacion1']->first()->$campo['relacion3']->$campo['relacion4']}}</td>
                    @else
                        <td>{{$user->$campo['relacion1']->$campo['relacion2']}}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ Form::open(['route' => 'report.postUsers', 'method' => 'POST', 'role' => 'form']) }}
    {{ Form::input('hidden','NameDocument',$NameUser) }}
    {{ Form::input('hidden','Cedula',$Cedula) }}
    {{ Form::input('hidden','Email',$Email) }}
    {{ Form::input('hidden','Groups',$Groups) }}
    {{ Form::input('hidden','CreateDateBegin',$CreateDateBegin) }}
    {{ Form::input('hidden','CreateDateEnd',$CreateDateEnd) }}
    {{ Form::input('hidden','State',$State) }}
    {{ Form::input('hidden','Print',1) }}
    <p>
        <a href="{{Route('report.getUsers')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite la pagina principal de reporte" data-original-title="Atras">Atras</a>
        <input type="submit" value="Imprimir" class="btn btn-custom-create" data-toggle="popover" data-content="Permite imprimir el reporte" data-original-title="Imprimir">
    </p>

    {{ Form::close() }}
@endsection
