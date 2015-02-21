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
            {{HTML::image($user->sign)}}
            <div class="col-md-6">
                    <h1 class="page-header">Actualizar datos del Usuario</h1>
                <div class="col-md-8">
                    {{Form::open(['action' => 'userController@changeSign', 'method' => 'POST', 'files' => true])}}
                    {{Form::label('sign',$user->sign ? 'Cambiar Firma: ' : 'Subir firma: ')}}
                    <div class="form-group">
                        {{Form::file('sign', ['class' => 'form-control'])}}
                        <span class="text-danger">{{$errors->first('avatar')}}</span>
                    </div>
                    {{Form::hidden('user_id', $user->id)}}
                    <div class="form-group">
                        {{Form::submit('Update avatar', ['class' => 'btn btn-info'])}}
                    </div>
                    {{Form::close()}}
                    {{ Form::model($user,['route' => ['user.update',$user->id], 'method' => 'PUT', 'role' => 'form']) }}

                    {{Field::input('text','full_name',null)}}
                    {{Field::input('text','email',null)}}
                    {{Field::input('text','password',"")}}
                    {{Field::input('text','password_confirmation',"",['placeholder' => 'Repita la contraseña'])}}

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
                <h1 class="page-header">Asignacion de Grupos</h1>
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
        </div>
    </div>




@endsection
