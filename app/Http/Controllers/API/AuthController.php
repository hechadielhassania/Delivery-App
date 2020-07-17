<?php

namespace App\Http\Controllers\API;

use App\User; 
use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class AuthController extends Controller 
{

    public function login(Request $request){ 

        $credentials = [
            'email' => $request->email, 
            'password' => $request->password
        ];

        if( auth()->attempt($credentials) ){ 
            $user = Auth::user(); 
            $success = [
                'user' => $user, 
                'token' => $user->createToken('DeliveryApp')->accessToken, 
            ]; 
            return response()->json(['data' => $success], 200);
        } else { 
            return response()->json(['error'=>'Unauthorised'], 401);
        } 
    }
    
    public function register(Request $request) 
    { 
        // add personalized messages for validation
        $messages = [
            'required'      => 'le champs :attribute est obligatoire',
            'email'         => 'le champs doit être un email valide',
            'confirmed'     => 'la confirmation du mot de passe ne corespond pas',
            'unique'        => 'l`email est déjà associé à un compte',
        ];

        // Create validators for the params passed to request with uniquness and confirmation checks 
        $validator = Validator::make($request->all(), [ 
            'firstname'    => 'required',
            'lastname'     => 'required',
            'username'      => 'required|unique:users,username', 
            'email'         => 'required|email|unique:users,email', 
            'password'      => 'required|required_with:password_confirmation', 
            'password_confirmation' => 'required|same:password', 
        ]);

        if ($validator->fails()) { 
            return response()->json([ 'error'=> $validator->errors() ]);
        }
        
        $data = $request->all(); 
        // Encrypte the password befor inserting in the Database
        $data['password'] = Hash::make($data['password']);
        
        $user = User::create($data); 
        $success = [
            'user' => $user, 
            'token' => $user->createToken('DeliveryApp')->accessToken, 
        ]; 
        
        return response()->json(['data'=>$success], 200);
    }
        
    public function user_detail() 
    { 
        $user = Auth::user();
        return response()->json(['data' => $user], 200); 
    } 

    public function logout(Request $request) 
    {
        auth()->user()->tokens->each(function($token,$key){
            $token->delete();
        });

        return response()->json(["success" => "Logged out successfully"],200);
    }

}