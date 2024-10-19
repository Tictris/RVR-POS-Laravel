<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function register(Request $request): JsonResponse {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $user = new User();
        $user->name         = $request->name ;
        $user->email        = $request->email;
        $user->password     = Hash::make($request->password);
        $user->save();


        $data = [];
        $data['status'] = true;
        $data['message'] = 'success Register';

        return new JsonResponse($data,200);

    }

    public function login(Request $request): JsonResponse{
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);


            $email     = $request->email;
            $password  = $request->password;

            if (Auth::attempt(['email' => $email,'password' => $password]))
            {
                $user = User::where('email',$request->email)->first();
                $token = $user->createToken("API_TOKEN")->accessToken;

                $data = [];
                $data['status']         = true;
                $data['message']        = 'success Login';
                $data['user_info']     = $user;
                $data['auth_check']    = Auth::user()->name;
                $data['token']          = $token;
                return new JsonResponse($data,200);
            } else {
                $data = [];
                $data['status']         = 'error';
                $data['message']        = 'Unauthorised';
                return new JsonResponse($data,401);
            }
        }



    public function logout(Request $request){
        if (Auth::user()) {

            $request->user()->token()->delete();

            return response()->json([
                'success' => true,
                'message' => 'Logged out successfully',
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Logged out failed',
            ], 401);
        }
    }
}
