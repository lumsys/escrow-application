<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;


class ProductController extends Controller
{
    public function index(Request $request){
        $user = User::where('id',$request->user()->id)->first();
        if(!is_null($user) && $user->userType == 'buyer')
        {
        $product = new Product();
        $product ->product_name=$req->input('product_name');
        $product ->service=$req->input('service');
        $product ->product_category=$req->input('product_category');
        $product ->user_id=$req->user_id;
        $product ->description=$req->input('description');
        $product ->quantity=$req->input('quantity');
        $product ->amount=$req->input('amount');
        $product ->file_path=$req->input('file_path')->store('products');
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
