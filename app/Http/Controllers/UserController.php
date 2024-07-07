<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return response()->json(['message' => 'Role assigned successfully']);
    }
}
