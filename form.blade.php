<label for="username">Username</label>
<input id="username" name="username" value="{{ old('username', $user->username ?? '') }}" required>

<label for="full_name">Full name</label>
<input id="full_name" name="full_name" value="{{ old('full_name', $user->full_name ?? '') }}" required>
