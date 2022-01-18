<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class mailController extends Controller
{
    //
public function index(){

    $data = array("name"=> "ogedengbe olumide", "body" => "test mail");

    Mail::send('welcome', $data, function($message){
    $message->to('lumiged4u@mail.com', 'çustomer')
    ->subject('api testing');
    $message->from('becodesescrowapp@gmail.com','test mail');
    });

    echo "mail sent check your inbox";
}
}
