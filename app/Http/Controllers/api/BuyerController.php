<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Buyer;

class BuyerController extends Controller
{
    //

    public function addProduct(Request $request)
    {
        $product = new buyer();
        $product ->product_name=$request->input('product_name');
        $product ->service=$request->input('service');
        $product ->product_category=$request->input('product_category');
        $product ->user_id=$request->user_id;
        $product ->description=$request->input('description');
        $product ->quantity=$request->input('quantity');
        $product ->amount=$request->input('amount');
        if($request->file_path && $request->file_path->isValid())
                {
                    $file_name = time().'.'.$request->file_path->extension();
                    $request->file_path->move(public_path('buyers'),$file_name);
                    $path = "public/buyers/$file_name";
                    $product->file_path = $path;
                }
        $product -> save();
        $user = User::where('id',$request->user()->id)->first();
        $shows = buyer::where(['id' => $user->user_id])->get();
            return response()->json(['success' => true, $shows]);
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
