<?php

// namespace App\Http\Controllers;

// use Illuminate\Http\Request;

// class AuthController extends Controller
// {
//     //
// }


namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\upper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request){


        $fields=$request->validate([
            "name"=>'required|string',
            "email"=>'required',
            "password"=>'required|confirmed'


        ]);
        // "email"=>'required',function(){},


        $user=User::create([
            'name'=>$fields['name'],
            'email'=>$fields['email'],
            'password'=>bcrypt($fields['password'])


        ]);

        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[

            'user'=>$user,
            'token'=>$token



        ];
        return response($response,201);


    }








    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');

    //     if (Auth::attempt($credentials)) {
    //         $user = Auth::user();
    //         $token = $user->createToken('API Token')->plainTextToken;

    //         return response()->json(['token' => $token], 200);
    //     }

    //     return response()->json(['error' => 'Unauthorized'], 401);
    // }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        // auth()->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully'], 200);
    }


    public function login(Request $request){


        $fields=$request->validate([
            "email"=>'required|',
            "password"=>'required'


        ]);

        $user=User::where('email',$fields['email'])->first();
        if (!$user || !Hash::check($fields['password'], $user->password)){
            return  response([
                'message'=>"you are not authorized"
            ],401);


        }



        $token=$user->createToken('myapptoken')->plainTextToken;
        $response=[

            'user'=>$user,
            'token'=>$token



        ];
        return response($response,201);


    }







}





