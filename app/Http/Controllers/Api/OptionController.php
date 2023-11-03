<?php

namespace App\Http\Controllers\Api;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\ResponseFactory;


class OptionController extends Controller
{
    public function index()
    {
        $option = Option::all();
        
        if($option->count() > 0){
        
        
            return response()->json([
                'status'=> 200,
                'option' =>$option
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
            'name' => 'required|string',
            'value' =>'required|string',
            'question_id' =>'required|integer'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()], 422);
        }else{
            $option = Option::create([
                'name' => $request->name,
                'value' => $request->value,
                'question_id' => $request->question_id,
            ]);             
        if($option){
                return response()->json([
                    'status' => 200,
                    'message' =>"option Created Successfully"
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
      $option = Option::find($id);
      if($option){
          return response()->json([
              'status' => 200,
              '$option' => $option
          ],200);
      }else{
          return response()->json([
              'status' => 404,
              'message'=>"No Such options found"
          ],404);
      }
    }

    public function update(Request $request , int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'value' =>'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ], 422);
        }else{
            $option = Option::find($id);
                    
        if($option){

            $option->update([
                'name' => $request->name,
                'value' => $request->value,
            ]); 

                return response()->json([
                    'status' => 200,
                    'message' =>"option Updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' =>"No Such Option Found !"
                ],404);
        }
        }
    }

    public function destory($id)
    {
        $option = Option::find($id);

        if ($option) {
            $option->delete();
            return response()->json([
                'message' => 'Option deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'message' => 'Option not found'
            ], 404);
        }
    }
   


}




