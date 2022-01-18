<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SellerController extends Controller
{
    //
    public function ShowStatus(){

    $user = User::where('id',$request->user()->id)->first();
    $seller = buyer::where(['user_id' => $user, 'status' => 'pending'])->get();
    return response()->json(['success' => true, $seller]);

}
}
