@extends('report.layout')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <h1 class="page-header text-center">Reportes Documentos</h1>

            <table id="" class=" display table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                <th><div class="bold">Serial</div></th>
                @foreach($campos as $campo)
                    <th><div class="bold">{{$campo['name']}}</div></th>
                @endforeach
                </thead>
                <tbody>
                @foreach($documents as $document)
                    <?php $i = false ?>
                    <?php $j = $document->workflow->last()->id ?>
                    <?php $h = $document->workflow->first()->id ?>
                    <tr>
                        <td>{{$document->serial}}</td>
                        @foreach($campos as $campo)
                            @if($campo['name']!='Estado')
                                @if($campo['relacion2']=='')
                                    <td>{{$document->$campo['relacion1']}}</td>
                                @elseif($campo['relacion2'] == 'last')
                                    <td>{{$document->$campo['relacion1']->last()->$campo['relacion3']->$campo['relacion4']}}</td>
                                @elseif($campo['relacion2']== 'first')
                                    <td>{{$document->$campo['relacion1']->first()->$campo['relacion3']->$campo['relacion4']}}</td>
                                @else
                                    <td>{{$document->$campo['relacion1']->$campo['relacion2']}}</td>
                                @endif
                            @else
                                @while(!$i)
                                    @if($document->workflow->find($j)->states_id == 3)
                                        @for($z = $j; $z >= $h; $z--)
                                            @if($document->workflow->find($z)->states_id == 4)
                                                <td>Rechazado</td>
                                                <?php $i = true ?>
                                            @endif
                                        @endfor
                                        @if($i==false)
                                            <td>Listo</td>
                                            <?php $i = true ?>
                                        @endif
                                    @elseif($document->workflow->find($j)->states_id == 4)
                                        <td>Rechazado</td>
                                        <?php $i = true ?>
                                    @elseif($document->workflow->find($j)->states_id == 2)
                                        <td>Pendiente</td>
                                        <?php $i = true ?>
                                    @endif
                                    <?php $j-- ?>
                                @endwhile
                            @endif
                        @endforeach
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection