<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function assignRole(Request $request, User $user)
    {
        $user->assignRole($request->role);
        return response()->json(['message' => 'Role assigned successfully']);
    }



    public function index(Request $request)
    {
        $perPage = $request->query('perPage', 10);

        // Fetch paginated bookings`
        $user = User::with([])->orderBy('id', 'desc')->paginate($perPage);

        // Return paginated collection of BookingResource
        // return ($user);
        return UserResource::collection($user);}
}
