<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\Laravel\Facades\Image;

class UserController extends Controller
{
    public function index(): View
    {
        return view('users.index', ['users' => User::latest()->get()]);
    }

    public function create(): View
    {
        return view('users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username'],
            'full_name' => ['required', 'string', 'max:255'],
        ]);

        $user = new User();
        $user->forceFill($data)->save();

        return to_route('users.index')->with('success', 'User account added.');
    }

    public function edit(User $user): View
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'username' => ['required', 'string', 'max:50', 'unique:users,username,' . $user->id],
            'full_name' => ['required', 'string', 'max:255'],
            'avatar' => ['nullable', 'image', 'max:2048'],
        ]);

        if ($request->hasFile('avatar')) {
            $image = Image::read($request->file('avatar'));
            $image->cover(300, 300);

            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }

            $path = 'avatars/' . uniqid('user_', true) . '.jpg';
            Storage::disk('public')->put($path, (string) $image->toJpeg(85));
            $data['avatar'] = $path;
        }

        $user->forceFill($data)->save();

        return to_route('users.index')->with('success', 'User account updated.');
    }
}
