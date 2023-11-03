<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Validator;


class QuizController extends Controller
{
        public function index()
        {
            $quizz = Quiz::all();
            
            if($quizz->count() > 0){
            
            
                return response()->json(
                    ['quizz' => $quizz], 200);
                } else{
                    return response()->json([
                        'status'=> 404,
                        'message' => 'No records found'
                    ], 404);
                }
            
            
        
        }
        public function store(Request $request)
        {
            $validator = Validator::make($request->all(), [
                'titre' => 'required|string',
                'description' => 'required|string',
                'image' => 'required|string',
                'categorie_id' =>'required|integer',
                'historique_id' =>'required|integer',
                'niveau_id' =>'required|integer',
            ]);
        
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            // dd($request->categorie_id);
            $quizz = Quiz::create([
                'titre' => $request->titre,
                'description' => $request->description,
                'image' => $request->image,
                'categorie_id' => $request->categorie_id,
                'historique_id' => $request->historique_id,
                'niveau_id' => $request->niveau_id,
            ]);
        
            return response()->json(['quizz' => $quizz], 201);
        }
        public function show($id)
        {
                $quizzes = Quiz::find($id);
                if($quizzes){
                    return response()->json([
                        'status' => 200,
                        'quizzes' => $quizzes
                    ],200);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message'=>"No Such Quizzez found"
                    ],404);
                }
        }
        public function edit($id)
        {
            $quizz = Quiz::find($id);
            if($quizz){
                return response()->json([
                    'status' => 200,
                    '$quizz' => $quizz
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message'=>"No Such quizz found"
                ],404);
            }
        }
        public function update(Request $request , int $id)
        {
            $validator = Validator::make($request->all(), [
                'titre' => 'required|string',
                'description' =>'required|string',
                'image' =>'required|string',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->message()
                ], 422);
            }else{
                $quizz = Quiz::find($id);
                        
            if($quizz){
    
                $quizz->update([
                    'titre' => $request->titre,
                    'description' => $request->description,
                    'image' => $request->image,
                ]); 
    
                    return response()->json([
                        'status' => 200,
                        'message' =>"quizz Updated Successfully"
                    ],200);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' =>"No Such quizz Found !"
                    ],404);
            }
            }
        }
        public function destroy($id)
        {
            $quizz = Quiz::find($id);
                if($quizz){
                        $quizz->delete();
                        return response()->json([
                            'status' => 200,
                            'message' =>"quizz Deleted Successfuly !"
                        ],202);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' =>"No Such quizz Found !"
                    ],404);
                }
        }

       
    }
