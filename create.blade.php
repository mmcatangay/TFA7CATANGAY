@extends('layouts.app')

@section('content')
<h1>Add User Account</h1>
@include('shared.errors')
<form method="POST" action="{{ route('users.store') }}">
    @csrf
    @include('users.form')
    <button type="submit">Save User</button>
</form>
@endsection
