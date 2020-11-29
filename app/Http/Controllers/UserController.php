<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator      =       Validator::make(
            $request->all(),
            [
                'name'              =>  'required|string|max:50',
                'email'             => 'required|email|unique:users',
                'password'          => 'required|alpha_num|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'login'      => false,
                'errorList' => $validator->errors()
            ]);
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => bcrypt($request->password)
        ]);

        return response()->json([
            'sucess'  => true,
            'message' => "L'utilisateur a bien été créé"
        ], 200);
    }

    /**
     * Login connection to apk
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator      =       Validator::make(
            $request->all(),
            [
                'email'             => 'required|email',
                'password'          => 'required|alpha_num|min:6',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                'error'      => true,
                'login'      => false,
                'errorList' => $validator->errors()
            ]);
        }
        $data = [
            'email'     => $request->email,
            'password'  => $request->password
        ];

        if (auth()->attempt($data)) {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            return response()->json([
                'error' => false,
                'login'  => true,
                'token'  => $token,
            ], 200);
        } else {
            return response()->json([
                'error' => true,
                'login' => false,
                'errorList' => 'il y a une erreur dans vos identifiant'
            ]);
        }
    }

    /**
     * logout and revoke token user of api
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $user = Auth::user();
        $check = $user->token()->revoke();

        if ($check) {
            return response()->json([
                'response'  => true,
                'message'   => 'Sucess logout'
            ], 200);
        }
    }
}
