@extends('dashboard.master')

@section('content')<br>

{{--  {{ var_dump( $errors->any() ) }}  --}}


@include('dashboard.partials.validation-error')

<form action=" {{ route("user.update", $user->id) }} " method="POST">
    @method('PUT')
    @include('dashboard.user._form', ['pasw' => false])
</form>

@endsection