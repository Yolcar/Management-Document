@extends('layout')
@extends('sidebar')
@extends('navbar')
@section('head')
    <script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
    <script src="http://code.highcharts.com/highcharts.js"></script>
    {{HTML::script('js/themes/gray.js')}}
    <script>
        var today = new Date();
        var year = today.getFullYear();
        $(function () {
            $('#container').highcharts({
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false
                },
                title: {
                    text: 'Documentos segun su estado'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                "credits": {
                    "enabled": false
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: 'Porcentaje',
                    data: [
                        @foreach($chartsDocumentState as $temp)
                            @if($temp['value']!=0)
                                ['{{Lang::get('validation.custom.state.'.$temp['name'])}}', {{$temp['value']}}/3],
                            @endif
                        @endforeach
                    ]
                }]
            });
        });
    </script>
    <script>
        var today = new Date();
        var year = today.getFullYear();
        $(function() {
            $('#chartsDocument').highcharts({
                "chart": {
                    "type": "column"
                },
                "title": {
                    "text": "Documentos del Año " + year
                },
                "credits": {
                    "enabled": false
                },
                "navigation": {
                    "buttonOptions": {
                        "align": "right"
                    }
                },
                "series": [
                    @foreach($chartsDocumentYear as $temp)
                    @if($temp['value']!=0)
                    {
                        "name": "{{Lang::get('validation.custom.month.'.$temp['month'])}}",
                        "data": [{{$temp['value']}}]
                    },
                    @endif
                    @endforeach
                ],
                "xAxis": {
                    "categories": [""]
                },
                "yAxis": {
                    "title": {
                        "text": "Total de documentos del Mes"
                    }
                }
            });
        });
    </script>
@endsection

@section('body')

    <h1 class="page-header">Reportes</h1>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="col-lg-4">
            <a href="{{Route('report.getUsers')}}"> <div class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-user"></i> <span class="text-large margin-left-15">{{$total_users->count()}}</span>
                    <br/>Usuarios Registrados
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a href="{{Route('report.getDocuments')}}"><div onclick="" class="stats-item margin-left-5 margin-bottom-12"><i class="glyphicon glyphicon-file"></i> <span class="text-large margin-left-15">{{$total_documents->count()}}</span>
                <br/>Total de Documentos</div>
            </a>
        </div>
        <a href="{{Route('report.getTemplates')}}"><div class="stats-item margin-left-5 margin-bottom-12"><i class="fa fa-file-text"></i> <span class="text-large margin-left-15">{{$total_templates->count()}}</span>
            <br/>Total de Plantillas
        </div>
        </a>
    </div>
    @if($total_documents->count()!=0)
    <div class="col-lg-12">
        <br>
        <div class="col-lg-6" id="chartsDocument"></div>
        <div class="col-lg-6" id="container"></div>
    </div>
    @endif


@endsection
