@extends('report.layout')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header">Reportes Plantillas</h1>
            <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <th><div class="bold">Serial</div></th>
                @foreach($campos as $campo)
                    <th><div class="bold">{{$campo['name']}}</div></th>
                @endforeach
                </thead>
                <tbody>
                @foreach($templates as $template)
                    <tr>
                        <td>{{$template->id}}</td>
                        @foreach($campos as $campo)
                            @if($campo['name'] == 'Estado')
                                @if($template->available == 0)
                                    <td>Desactivado</td>
                                @else
                                    <td>Disponible</td>
                                @endif
                            @elseif($campo['relacion2']=='')
                                <td>{{$template->$campo['relacion1']}}</td>
                            @elseif($campo['relacion2'] == 'last')
                                <td>{{$template->$campo['relacion1']->last()->$campo['relacion3']->$campo['relacion4']}}</td>
                            @elseif($campo['relacion2']== 'first')
                                <td>{{$template->$campo['relacion1']->first()->$campo['relacion3']->$campo['relacion4']}}</td>
                            @else
                                <td>{{$template->$campo['relacion1']->$campo['relacion2']}}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection