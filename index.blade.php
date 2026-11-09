@extends('layouts.app')

@section('content')
<h1>User Accounts</h1>
@if (session('success'))<p>{{ session('success') }}</p>@endif
<a href="{{ route('users.create') }}">Add user</a>
@foreach ($users as $user)
    <article>
        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : asset('images/avatar-placeholder.svg') }}"
             alt="{{ $user->avatar ? $user->full_name : 'No profile picture' }}" width="80" height="80">
        <p>{{ $user->full_name }} ({{ $user->username }})
            <a href="{{ route('users.edit', $user) }}">Edit</a>
        </p>
    </article>
@endforeach
@endsection
