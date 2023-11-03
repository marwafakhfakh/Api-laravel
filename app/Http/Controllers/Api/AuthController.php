<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



//class AuthController extends Controller
{

    //public function login(Request $request)
                { 
                
                try{
                    $input = $request->all();
                    $validator = Validator::make($input,[
                        "email"=>"required|email",
                        "password"=>"required",
                    ]);
                    if($validator->fails())
                    {
                        return response()->json([
                            "status"=>false,
                            "message"=>"Erreur de validation",
                            "errors" =>$validator->errors(),
                        ],422,); 
                    }
                
                /* if(!Auth::attempt($request->only(['email','password']))){
                        return response()->json([
                            "status"=>false,
                            "message"=>"Email ou mot de passe incorect",
                            "errors" =>$validator->errors(),
                        ],401,); 
                    }*/
                    { 

                
                    }
                    $user = User::where('email',$request->email)->first();
                    return response()->json([
                        "status"=>true,
                        "message"=>"Utilisateur connecté avec succès",
                        "data" =>[
                            "token"=> $user->createToken('auth_user')->plainTextToken,
                            "token_type"=>"Bearer",
                        ],
                    ]); 
                    } catch(\Throwable $th){
                            return response()->json([
                                "status"=>false,
                                "message"=>$th->getMessage(),
                            ],500,); 
                        }
                }
}
    /*public function register(Request $request)
    {
        try{
            $input = $request->all();
            $validator = Validator::make($input,[
                "name"=>"required",
                "email"=>"required|email|unique:users,email",
                "password"=>"required|confirmed",
                "password_confirmation"=>"required",
            ]);
            if($validator->fails()){
                return response()->json([
                    "status"=>false,
                    "message"=>"Erreur de validation",
                    "errors" =>$validator->errors(),
                ],422,); 
            }
            $input['password']=Hash::make($request->password);
            $user = User::create($input);
            return response()->json([
                "status"=>true,
                "message"=>"Utilisateur crée avec succès",
                "data" =>[
                    "token"=> $user->createToken('auth_user')->plainTextToken,
                    "token_type"=>"Bearer",
                ],
            ]); 
      } catch(\Throwable $th){
            return response()->json([
                "status"=>false,
                "message"=>$th->getMessage(),
            ],500,); 
        }
    }
    public function profile(Request $request){
        return response()->json([
            "status"=>true,
            "message"=>"Profile Utilisateur ",
            "data" =>$request->user(),
        ]);
    }

    public function edit(Request $request)
    {
        try{
         $input = $request->all();
         $validator = Validator::make($input,[
             "email"=>"email|unique:users,email",
      
         ]);
         if($validator->fails()){
             return response()->json([
                 "status"=>false,
                 "message"=>"Erreur de validation",
                 "errors" =>$validator->errors(),
             ],422,); 
         }
    
         $request->user()->update($input);
         return response()->json([
             "status"=>true,
             "message"=>"Utilisateur Modifier avec succès",
             "data" => $request->user(),
         ]); 
         } catch(\Throwable $th){
                 return response()->json([
                     "status"=>false,
                     "message"=>$th->getMessage(),
                 ],500,); 
             }
    }
    
} */
