<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserProfileController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('pages.user-management')
            ->withUsers($users);
    }

    public function show()
    {
        $user = Auth::user();

        return view('pages.user-profile')
            ->withUser($user);
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $user->fill($request->all())->save();

        return redirect('user-management')
            ->with('succes', 'User "'. $user->username .'" succesfully updated');
    }
}
