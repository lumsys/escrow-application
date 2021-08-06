<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Product;
use User;


class ProductController extends Controller
{
    public function index(Request $request){

        
        $user = User::where('id',$request->user()->id)->first();
        if(!is_null($user) && $user->userType == 'buyer')
        {
        $product = new Product();
        $product ->product_name=$req->input('product_name');
        $product ->service=$request->input('service');
        $product ->product_category=$request->input('product_category');
        $product ->user_id=$request->user_id;
        $product ->description=$request->input('description');
        $product ->quantity=$request->input('quantity');
        $product ->amount=$request->input('amount');
        $product ->file_path=$request->file('file')->store('products');
        $product -> save();
        $shows = product::where(['id' => $user->user_id])->get();
            return response()->json(['success' => true,'shows' => $show]);
         } else 
         {
            return response()->json(['success' => false, 'shows' => null]);
         }
        }

        public function updateUsertype(Request $request, $id)
        {
        $status = User::where('id', $id)->first();
        if($status){
            $status->usertype == 'buyer';
            $status->save();
        }else
        {
            $status->usertype == 'seller';
            $status->save();
        }
        
    }
}
