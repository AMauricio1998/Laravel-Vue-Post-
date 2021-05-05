@extends('dashboard.master')

@section('content')<br>

{{--  {{ var_dump( $errors->any() ) }}  --}}


@include('dashboard.partials.validation-error')

<form action=" {{ route("user.store") }} " method="POST">
@include('dashboard.user._form', ['passw' => true])
</form>


@endsection

