<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|min:3',
        //     'email' => 'required|email|unique:users',
        //     'password' => 'required|min:6',
        // ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_img'=>'img/p.jpg',
            'password' => bcrypt($request->password),
            'is_admin' => false
        ]);
            // return "hereeeeee";
        // $token = $user->createToken('programingVh')->accessToken;
        $token = $user->createToken('LaravelAuth')->accessToken;

        return response()->json(['token' => $token], 200);
    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
//         $credentials = [
//             'email' => $request->email,
//             'password' => $request->password
//         ];
// return "mmmmm";
//         if (auth()->attempt($credentials)) {
//             $token = auth()->user()->createToken('TutsForWeb')->accessToken;
//             return response()->json(['token' => $token], 200);
//         } else {
//             return response()->json(['error' => 'UnAuthorised'], 401);
//         }

        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Returns Authenticated User Details
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }
}
