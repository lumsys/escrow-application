<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\category;

class CategoryController extends Controller
{
    //

    public function storeCategory(Request $request){
        //
            $category = new category();
            $category ->name=$request->input('name');
            $category->user_id = $request->user()->id;
            $category -> save();
    
            return response()->json(['success' => true,]);
}

public function getCategory()
{
    $category = Category::all();
    return response()->json(['success' => true, $category]);
    }

}