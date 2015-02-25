@extends('report.layout')

@section('body')
    <div class="container-fluid">
        <div class="row">
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
        </div>
    </div>
    @endsection