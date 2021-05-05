@extends('dashboard.master')

@section('content')<br>

{{--  {{ var_dump( $errors->any() ) }}  --}}


@include('dashboard.partials.validation-error')

<form action=" {{ route("post.update", $post->id) }} " method="POST">
    @method('PUT')
    @include('dashboard.post._form')
</form>

<br>

<form action=" {{ route("post.image", $post) }} " enctype="multipart/form-data" method="POST">
@csrf
    <div class="row">
        <div class="col">
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <div class="col">
            <input type="submit" value="subir" class="btn btn-primary">
        </div>
    </div>
</form>

@endsection