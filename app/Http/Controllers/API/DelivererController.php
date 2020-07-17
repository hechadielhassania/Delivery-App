<?php

namespace App\Http\Controllers\API;

use App\User; 
use Validator;
use Illuminate\Http\Request; 
use App\Http\Controllers\Controller; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; 
use Symfony\Component\HttpFoundation\Response;


class DelivererController extends Controller 
{

    public function about(Request $request, $deliverer_username){ 

        // $validator = Validator::make($deliverer_username, [ 
        //     'deliverer_username' => 'required'
        // ]);

        // if ($validator->fails()) { 
        //     return response()->json([ 'error'=> $validator->errors() ]);
        // }
        // fetch deliverer from database if exists using his username
        $deliverer = User::where('username', $request->input('deliverer_username'));
        if (!$deliverer) {
            return response()->json(['error'=> 'Deliverer not found'], 404);
        }

        $success['deliverer_about'] =  $deliverer; 
        return response()->json(['success' => $success], 200);
    }

}