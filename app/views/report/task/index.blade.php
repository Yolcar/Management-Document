@extends('layout')
@extends('sidebar')
@extends('navbar')
@section('head')
    <script>
        function fillable(campo){
            var table = $('table.display.'+campo).dataTable();
            var data = table.$('input').serialize();
            var temp = data.split('&');
            document.getElementById(campo).value = '';
            for(var i=0;i<temp.length;i++) {
                do{
                    temp[i] = temp[i].replace('+',' ');
                }while(temp[i].contains('+'));
                temp[i] = temp[i].replace(campo + '=','');
                if(document.getElementById(campo).value == ''){
                    document.getElementById(campo).value += temp[i];
                }else{
                    document.getElementById(campo).value += '|'+temp[i];
                }
            }
        }
    </script>
@endsection

@section('body')
    <h1 class="page-header">Reportes Tareas</h1>
    <div class="col-md-12">Filtro de Busqueda: </div>
    {{ Form::open(['route' => 'report.postTasks', 'method' => 'POST', 'role' => 'form']) }}
    <div class="col-md-12">{{Field::input('text','NameTask')}}</div>
    <div class="col-md-12"><div class="col-md-6">{{Field::input('datepicker','CreateDateBegin',null,['class'=> "datepicker", 'data-provide'=>"datepicker", 'data-date-end-date'=>"now()",'data-date-language' => "es",'data-date-start-date'=>"-2y", 'data-date-format' => "dd-mm-yyyy"])}}</div><div class="col-md-6">{{Field::input('datepicker','CreateDateEnd',null,['class'=> "datepicker", 'data-provide'=>"datepicker", 'data-date-end-date'=>"now()",'data-date-language' => "es",'data-date-start-date'=>"-2y", 'data-date-format' => "dd-mm-yyyy" ])}}</div></div>
    <div class="col-md-12">{{ Form::label('byState','Estado') }}{{Field::select('State',['Desactivado','Disponible','Mostras Ambos'])}}</div>
    <p>
        <a href="{{Route('report.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Permite la pagina principal de reporte" data-original-title="Atras">Atras</a>
        <input type="submit" value="Crear" class="btn btn-custom-create" data-toggle="popover" data-content="Permite crear documentos" data-original-title="Crear">
    </p>

    {{ Form::close() }}
@endsection
