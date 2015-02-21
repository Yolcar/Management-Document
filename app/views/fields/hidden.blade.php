<div class="form-group">
    {{ $control }}
    @if( isset($error) )
        <div class="alert alert-danger">{{$error}}</div>
    @endif
</div>