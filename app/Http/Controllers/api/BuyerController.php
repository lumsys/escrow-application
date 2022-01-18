<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Buyer;
//use App\Auth;

class BuyerController extends Controller
{
    //
    public function addProduct(Request $request)
    {
        //$user = User::where('id',$request->user()->id)->first();

        $product = new buyer();
        $product ->product_name=$request->input('product_name');
        $product ->service=$request->input('service');
        $product ->product_category=$request->input('product_category');
        $product->user_id = $request->user()->id;
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
        $user = User::where('id',$request->user()->id)->first()->id;
        $shows = buyer::where(['user_id' => $user])->get();
        return response()->json(['success' => true, $shows]);
        }

        public function updateUsertype(Request $request)
        {
        $user = User::where('id', $request->user()->id)->firstOrFail(); 
        $user->usertype = $request->usertype;
        $user->saveOrFail();
        return response()->json(['success' => true]);
    }

    public function deleteProduct($id)
    {
        $produx = buyer::find($id)->first();
        $produx->delete();
        return response()->json(['success' => true, 'message' => 'Product has been successfully deleted']);
    }
}
