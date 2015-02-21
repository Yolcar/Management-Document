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
    <h1 class="page-header">Reportes Documentos</h1>
    <table id="table" class="display table table-striped table-bordered" cellspacing="0" width="100%">
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
    {{ Form::open(['route' => 'report.postDocuments', 'method' => 'POST', 'role' => 'form']) }}
    {{ Form::input('hidden','NameDocument',$NameDocument) }}
    {{ Form::input('hidden','NameTypeDocument',$NameTypeDocument) }}
    {{ Form::input('hidden','CreateDateBegin',$CreateDateBegin) }}
    {{ Form::input('hidden','CreateDateEnd',$CreateDateEnd) }}
    {{ Form::input('hidden','ExecuteDateBegin',$ExecuteDateBegin) }}
    {{ Form::input('hidden','ExecuteDateEnd',$ExecuteDateEnd) }}
    {{ Form::input('hidden','State',$State) }}
    {{ Form::input('hidden','CreatedUser',$CreatedUser) }}
    {{ Form::input('hidden','Print',1) }}
    <p>
        <a href="{{Route('report.getDocuments')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite la pagina principal de reporte" data-original-title="Atras">Atras</a>
        <input type="submit" value="Imprimir" class="btn btn-custom-create" data-toggle="popover" data-content="Permite imprimir el reporte" data-original-title="Imprimir">
    </p>

    {{ Form::close() }}
@endsection
