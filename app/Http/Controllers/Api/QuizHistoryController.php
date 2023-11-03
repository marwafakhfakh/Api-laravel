<?php

namespace App\Http\Controllers\Api;
use App\Models\QuizHistory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class QuizHistoryController extends Controller
{
        public function index()
        {
                $quizzeshistorical = QuizHistory::all();
                
                if($quizzeshistorical->count() > 0){
                    return response()->json(
                        ['quizzeshistorical' => $quizzeshistorical], 200);
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
                'date' => 'required|date_format:Y-m-d',
                'response_time' => 'required|date_format:H:i:s',
                'score' => 'required|integer',
                'titre' => 'required|string',
            ]);
        
            if ($validator->fails()) {
                return response()->json(
                    ['errors' => $validator->errors()], 422);
            }
        
            $quizzeshistorical = QuizHistory::create([
                'date' => Carbon::createFromFormat('Y-m-d', $request->date),  // Format the date correctly
                'response_time' => $request->response_time,
                'score' => $request->score,
                'titre'=> $request->titre,
            ]);
        
            return response()->json(
                ['quizzeshistorical' => $quizzeshistorical]
                , 201);
        }
        public function show($id)
        {
                $quizzeshistorical = QuizHistory::find($id);
                if($quizzeshistorical){
                    return response()->json([
                        'status' => 200,
                        'quizzeshistorical' => $quizzeshistorical
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
            $quizzeshistorical = QuizHistory::find($id);
            if($quizzeshistorical){
                return response()->json([
                    'status' => 200,
                    '$quizzeshistorical' => $quizzeshistorical
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message'=>"No Such quizzeshistorical found"
                ],404);
            }
        }
        public function update(Request $request , int $id)
        {

            $validator = Validator::make($request->all(), [
                'date' => 'required|date_format:Y-m-d',
                'response_time' => 'required|date_format:H:i:s',
                'score' => 'required|string',
                'titre' =>'required|string',
            ]);
            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()
                ], 422);
            }else{
                $quizzeshistorical = QuizHistory::find($id);
                if($quizzeshistorical){

                    $quizzeshistorical->update([
                        'date' => Carbon::createFromFormat('Y-m-d', $request->date), 
                        'response_time' => $request->response_time,
                        'score' => $request->score,
                        'titre' => $request->titre,
                    ]); 
                        return response()->json([
                            'status' => 200,
                            'message' =>"quizzeshistorical Updated Successfully"
                        ],200);
                    }else{
                        return response()->json([
                            'status' => 404,
                            'message' =>"No Such quizzeshistorical Found !"
                        ],404);
                }
                }
        }
        public function destroy($id)
        {
            $quizzeshistorical = QuizHistory::find($id);
                if($quizzeshistorical){
                        $quizzeshistorical->delete();
                        return response()->json([
                            'status' => 200,
                            'message' =>"quizzeshistorical Deleted Successfuly !"
                        ],202);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' =>"No Such quizzeshistorical Found !"
                    ],404);
                }
        }
}
