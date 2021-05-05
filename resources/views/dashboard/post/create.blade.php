@extends('dashboard.master')

@section('content')<br>

{{--  {{ var_dump( $errors->any() ) }}  --}}


@include('dashboard.partials.validation-error')

<form action=" {{ route("post.store") }} " method="POST">
@include('dashboard.post._form')
</form>


@endsection

