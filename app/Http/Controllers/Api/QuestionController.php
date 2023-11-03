<?php

namespace App\Http\Controllers\Api;
use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        if($questions->count() > 0){
        
        
        return response()->json([
            'status'=> 200,
            'questions' =>$questions
        ], 200);
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
            'text' => 'required|string',
            'number' =>'required|integer',
            'option' =>'required|string',
            'quiz_id' =>'required|integer',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ], 422);
        }else{
            $question = Question::create([
              
                'text' => $request->text ,
                'number' =>$request->number,
                'option' =>$request->option,
                'quiz_id' =>$request->quiz_id,
            ]);             
        if($question){
                return response()->json([
                    'status' => 200,
                    'message' =>"Question Created Successfully"
                ],200);
        }else{
            return response()->json([
                'status' => 500,
                'message' =>"Something Went Wrong !"
            ],500);
        }
        }
    }
  
    public function edit($id)
    {
      $question = Question::find($id);
      if($question){
          return response()->json([
              'status' => 200,
              '$question' => $question
          ],200);
      }else{
          return response()->json([
              'status' => 404,
              'message'=>"No Such questions found"
          ],404);
      }
    }

    public function update(Request $request , int $id)
    {
        $validator = Validator::make($request->all(), [
            'text' => 'required|string',
            'text' => 'required|string',
            'number' =>'required|integer',
        ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $question->message()
            ], 422);
        }else{
            $question = Question::find($id);
            if($question){

                $question->update([
                    'text' => $request->text,
                    'option' => $request->option,
                    'number' => $request->number,
                ]); 

                    return response()->json([
                        'status' => 200,
                        'message' =>"question Updated Successfully"
                    ],200);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' =>"No Such question Found !"
                    ],404);
            }
            }
    }
      public function destory($id)
    {
        $question = Question::find($id);
        if($question){
                $question->delete();
                return response()->json([
                    'status' => 200,
                    'message' =>"Question Deleted Successfuly !"
                ],202);
        }else{
            return response()->json([
                'status' => 404,
                'message' =>"No Such Question Found !"
            ],404);
        }
    }
    


}

