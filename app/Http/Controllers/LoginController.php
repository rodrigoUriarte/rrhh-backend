<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //$validated = $request->validated();

        $user = User::where('email', $request->email)->first();
        $hash = Hash::check($request->password, $user->password);
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => ['Sus credenciales no son correctas.']
            ], 401);
        }

        $token = $user->createToken('my-app-token')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
