<?php

namespace App\Http\Controllers\Api;
use App\Models\Niveau;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\ResponseFactory;


class NiveauController extends Controller
{

    public function index()
    {
        $niveau = Niveau::all();
        
        if($niveau->count() > 0){
        
        
            return response()->json([
                'status'=> 200,
                'niveau' =>$niveau
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
        {
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string',
                'prénom' =>'required|string',
            ]);
    
            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->messages()], 422);
            }else{
                $niveau = Niveau::create([
                    'nom' => $request->nom,
                    'prénom' => $request->prénom,
                ]);             
            if($niveau){
                    return response()->json([
                        'status' => 200,
                        'message' =>"niveau Created Successfully"
                    ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' =>"Something Went Wrong !"
                ],500);
            }
            }
        }
    }

    public function show($id)
    {
          $niveau = Niveau::find($id);
          if($niveau){
              return response()->json([
                  'status' => 200,
                  'niveau' => $niveau
              ],200);
          }else{
              return response()->json([
                  'status' => 404,
                  'message'=>"No Such Category found"
              ],404);
          }
    }

    public function edit($id)
    {
      $niveau = Niveau::find($id);
      if($niveau){
          return response()->json([
              'status' => 200,
              '$niveau' => $niveau
          ],200);
      }else{
          return response()->json([
              'status' => 404,
              'message'=>"No Such niveau found"
          ],404);
      }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:191',
            'prénom' =>'required|string|max:191',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ], 422);
        }else{
            $niveau = Niveau::find($id);
                    
        if($niveau){

            $niveau->update([
                'nom' => $request->nom,
                'prénom' => $request->prénom,
            ]); 

                return response()->json([
                    'status' => 200,
                    'message' =>"niveau Updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' =>"No Such Niveau Found !"
                ],404);
        }
        }
    }
    public function destroy($id)
    {
        $niveau = Niveau::find($id);

        if ($niveau) {
            $niveau->delete();
            return response()->json(['message' => 'Niveau deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Niveau not found'], 404);
        }
    }

}
