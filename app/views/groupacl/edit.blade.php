@extends('layout')
@extends('sidebar')
@extends('navbar')

@section('body')
    <script>
        $(document).on('click','.button-add-group',function(){
            $('.form-add-group').submit();
        });
        $(document).on('click','.button-del-group',function(){
            $('.form-add-group').submit();
            name = $(this).attr('name');
            $('form[name='+name+']').submit();
        });

    </script>


    <div class="container">
        <div class="row">
            <div class="col-md-6">
                    <h1 class="page-header">Editar Grupo Funcional</h1>
                <div class="col-md-8">
                    {{ Form::model($groupacl,['route' => ['groupacl.update',$groupacl->id], 'method' => 'PUT', 'role' => 'form']) }}

                    {{Field::input('text','name',null)}}

                    <p>
                        <a href="{{Route('groupacl.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina anterior de lista de usuarios" data-original-title="Atras">Atras</a>
                        <input type="submit" value="Guardar" class="btn btn-custom-edit" data-toggle="popover" data-content="Permiter guardar los cambios realizados" data-original-tittle="Guardar">
                    </p>
                    {{-- successful message --}}
                    <?php $message = Session::get('message'); ?>
                    @if( isset($message) )
                        <div class="alert alert-success">{{$message}}</div>
                    @endif

                    {{Form::close()}}
                </div>
            </div>
            <div class="col-md-6">
                <h1 class="page-header">Modulos</h1>
                <div class="col-md-8">
                    <div class="col-md-12 col-xs-12">
                        <h4><i class="fa fa-th"></i> Modulos</h4>
                        {{-- add group --}}
                        {{Form::open(['route' => ['groupacl.addModule'], 'class' => 'form-add-group', 'method' => 'POST', 'role' => 'form']) }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon form-button button-add-group"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                {{Field::select('module_id',$module)}}
                                {{Form::hidden('groupacl_id', $groupacl->id)}}
                            </div>
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                        {{Form::close()}}
                        {{-- delete group --}}
                        @if( ! $groupacl->module->isEmpty() )
                            @foreach($groupacl->module()->get() as $module)
                                {{Form::open(['route' => ['groupacl.deleteModule'], 'class' => 'form-delete-group', 'name' =>$module->id, 'method' => 'POST', 'role' => 'form']) }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon form-button button-del-group" name="{{$module->id}}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
                                        {{Form::text('module_name', $module->name, ['class' => 'form-control', 'readonly' => 'readonly'])}}
                                        {{Form::hidden('groupacl_id', $groupacl->id)}}
                                        {{Form::hidden('module_id', $module->id)}}

                                    </div>
                                </div>
                                {{Form::close()}}
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
