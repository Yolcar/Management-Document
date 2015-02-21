<div class="form-group">
    {{ $control }}
    <script>
        CKEDITOR.replace( '{{ $name }}' )
    </script>

    @if( isset($error) )
        <div class="alert alert-danger">{{$error}}</div>
    @endif
</div>