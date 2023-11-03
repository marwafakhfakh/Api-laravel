<?php

namespace App\Http\Controllers\Api;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;
//use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
   /* public function Index()
        {
                    $categories = Category::all();
                if($categories->count() > 0){
                
                
                return response()->json([
                    'status'=> 200,
                    'categories' =>$categories
                    
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
                'name' => 'required|string|max:191',
                'departement' =>'required|string|max:191',
                'image' =>'required|string',
            ]);

            if($validator->fails()){
                return response()->json([
                    'status' => 422,
                    'errors' => $validator->message()
                ], 422);
            }else{
                $categorie = Category::create([
                    'name' => $request->name,
                    'departement' => $request->departement,
                    'image' => $request->image,
                ]);             
            if($categorie){
                    return response()->json([
                        'status' => 200,
                        'message' =>"Categorie Created Successfully"
                    ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' =>"Something Went Wrong !"
                ],500);
            }
            }
        }
      public function show($id)
      {
            $categorie = Category::find($id);
            if($categorie){
                return response()->json([
                    'status' => 200,
                    'categorie' => $categorie
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
        $categories = Category::find($id);
        if($categories){
            return response()->json([
                'status' => 200,
                '$categories' => $categories
            ],200);
        }else{
            return response()->json([
                'status' => 404,
                'message'=>"No Such categories found"
            ],404);
        }
      }
     
      public function update(Request $request , int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'departement' =>'required|string',
            'image' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->message()
            ], 422);
        }else{
            $categories = Category::find($id);
                    
        if($categories){

            $categories->update([
                'name' => $request->name,
                'departement' => $request->departement,
                'image' => $request->image,
            ]); 

                return response()->json([
                    'status' => 200,
                    'message' =>"categories Updated Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' =>"No Such categories Found !"
                ],404);
        }
        }
    }

    public function destory($id)
    {
        $categorie = Category::find($id);
        if($categorie){
                $categorie->delete();
                return response()->json([
                    'status' => 200,
                    'message' =>"Category Deleted Successfuly !"
                ],20);
        }else{
            return response()->json([
                'status' => 404,
                'message' =>"No Such Category Found !"
            ],404);
        }
    }
*/
public function create(Request $request)
{
    $categories=new Category();
    $request->validate([
        'name'=>'required',
        'departement'=> 'required',
        'image'=>'required|max:1024'
    ]);

    $filename="";
    if($request->hasFile('image')){
        $filename=$request->file('image')->store('posts','public');
    }else{
        $filename=Null;
    }

    $categories->name=$request->name;
    
    $categories->departement=$request->departement;
    $categories->image=$filename;
    $result=$categories->save();
    if($result){
        return response()->json(['success'=>true]);
    }else{
        return response()->json(['success'=>false]);
    }
    
}
public function get()
{
    $categories=Category::orderBy('id','DESC')->get();
    return response()->json($categories);
}
public function edit($id)
{
    $categories=Category::findOrFail($id);
    return response()->json($categories);
}
public function update(Request $request,$id)
{
    $categories=Category::findOrFail($id);
    
    $destination=public_path("storage\\".$categories->image);
    $filename="";
    if($request->hasFile('new_image')){
        if(File::exists($destination)){
            File::delete($destination);
        }

        $filename=$request->file('new_image')->store('posts','public');
    }else{
        $filename=$request->image;
    }

    $categories->name=$request->name;
    $categories->departement=$request->departement;
    $categories->image=$filename;
    $result=$categories->save();
    if($result){
        return response()->json(['success'=>true]);
    }else{
        return response()->json(['success'=>false]);
    }
}
public function delete($id)
{
    $categories=Category::findOrFail($id);
    $destination=public_path("storage\\".$categories->image);
    if(File::exists($destination)){
        File::delete($destination);
    }
    $result=$categories->delete();
    if($result){
        return response()->json(['success'=>true]);
    }else{
        return response()->json(['success'=>false]);
    }
}

}

