@extends('dashboard.master')

@section('content')<br>

    <div class="form-group">
        <label for="title">Titulo</label>
        <input readonly class="form-control" type="text" name="title" id="title" value="{{ $category->title }}">
    </div>

    <div class="form-group">
        <label for="url_clean">Url limpia</label>
        <input readonly class="form-control" type="text" name="url_clean" id="url_clean" value="{{ $category->url_clean }}">
    </div>        

@endsection

