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
        $(document).on('click','.button-add-groupacl',function(){
            $('.form-add-groupacl').submit();
        });
        $(document).on('click','.button-del-groupacl',function(){
            $('.form-add-groupacl').submit();
            name = $(this).attr('name');
            $('form[name=acl'+name+']').submit();
        });
    </script>
    <div class="container">
        <div class="row">

            <div class="col-md-6">
                    <h1 class="page-header">Actualizar datos del Usuario</h1>
                <div class="col-md-8">
                    {{Form::open(['action' => 'userController@changeSign', 'method' => 'POST', 'files' => true])}}
                    {{Form::close()}}
                    {{ Form::model($user,['route' => ['user.update',$user->id], 'method' => 'PUT', 'role' => 'form', 'files' => true]) }}

                    {{Field::input('text','full_name',null)}}
                    {{Field::input('text','email',null)}}
                    {{Field::input('text','cedula',null)}}
                    {{Field::input('text','password',"")}}
                    {{Field::input('text','password_confirmation',"",['placeholder' => 'Repita la contraseña'])}}
                    {{Field::input('file','sign')}}
                    @if($user->sign)
                    {{HTML::image($user->sign)}}
                    @endif
                    <p>
                        <input type="submit" value="Guardar" class="btn btn-custom-edit" data-toggle="popover" data-content="Permiter guardar los cambios realizados" data-original-tittle="Guardar">
                        <a href="{{Route('user.index')}}" class="btn btn-custom-back" data-toggle="popover" data-content="Regresa a la pagina anterior de lista de usuarios" data-original-title="Atras">Atras</a>
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
                <h1 class="page-header">Grupos de Trabajo</h1>
                <div class="col-md-8">
                    <div class="col-md-12 col-xs-12">
                        <h4><i class="fa fa-users"></i>Grupos</h4>
                        {{-- add group --}}
                        {{Form::open(['route' => ['user.addGroup'], 'class' => 'form-add-group', 'method' => 'PUT', 'role' => 'form']) }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon form-button button-add-group"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                {{Field::select('group_id',$group)}}
                                {{Form::hidden('user_id', $user->id)}}
                            </div>
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                        {{Form::close()}}
                        {{-- delete group --}}
                        @if( ! $user->groups->isEmpty() )
                            @foreach($user->groups()->get() as $group)
                                {{Form::open(['route' => ['user.deleteGroup'], 'class' => 'form-delete-group', 'name' =>$group->id, 'method' => 'PUT', 'role' => 'form']) }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon form-button button-del-group" name="{{$group->id}}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
                                        {{Form::text('group_name', $group->name, ['class' => 'form-control', 'readonly' => 'readonly'])}}
                                        {{Form::hidden('user_id', $user->id)}}
                                        {{Form::hidden('group_id', $group->id)}}

                                    </div>
                                </div>
                                {{Form::close()}}
                            @endforeach
                        @endif

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <h1 class="page-header">Grupos Funcional</h1>
                <div class="col-md-8">
                    <div class="col-md-12 col-xs-12">
                        <h4><i class="fa fa-users"></i>Grupos</h4>
                        {{-- add group --}}
                        {{Form::open(['route' => ['user.addGroupFun'], 'class' => 'form-add-groupacl', 'method' => 'PUT', 'role' => 'form']) }}
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon form-button button-add-groupacl"><span class="glyphicon glyphicon-plus-sign add-input"></span></span>
                                {{Field::select('groupacl_id',$groupacl)}}
                                {{Form::hidden('user_id', $user->id)}}
                            </div>
                            <span class="text-danger">{{$errors->first('name')}}</span>
                        </div>
                        {{Form::close()}}
                        {{-- delete group --}}
                        @if( ! $user->groupacls->isEmpty() )
                            @foreach($user->groupacls()->get() as $groupacl)
                                {{Form::open(['route' => ['user.deleteGroupFun'], 'class' => 'form-delete-groupacl', 'name' => 'acl'.$groupacl->id, 'method' => 'PUT', 'role' => 'form']) }}
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon form-button button-del-groupacl" name="{{$groupacl->id}}"><span class="glyphicon glyphicon-minus-sign add-input"></span></span>
                                        {{Form::text('groupacl_name', $groupacl->name, ['class' => 'form-control', 'readonly' => 'readonly'])}}
                                        {{Form::hidden('user_id', $user->id)}}
                                        {{Form::hidden('groupacl_id', $groupacl->id)}}

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
