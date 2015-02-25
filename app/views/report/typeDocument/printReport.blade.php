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
                @foreach($typeDocuments as $typeDocument)
                    <tr>
                        <td>{{$typeDocument->id}}</td>
                        @foreach($campos as $campo)
                            @if($campo['name'] == 'Estado')
                                @if($typeDocument->available == 0)
                                    <td>Desactivado</td>
                                @else
                                    <td>Disponible</td>
                                @endif
                            @elseif($campo['relacion2']=='')
                                <td>{{$typeDocument->$campo['relacion1']}}</td>
                            @else
                                <td>{{$typeDocument->$campo['relacion1']->$campo['relacion2']}}</td>
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection