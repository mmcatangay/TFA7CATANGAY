@extends('layouts.app')

@section('content')
<h1>Edit User Account</h1>
@include('shared.errors')
<form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('users.form')
    <label for="avatar">Profile picture</label>
    <input id="avatar" type="file" name="avatar" accept="image/*">
    <small>Optional image, maximum 2 MB.</small>
    <button type="submit">Update User</button>
</form>
@endsection
