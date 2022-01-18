<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\service;

class ServiceController extends Controller
{
    public function storeService(Request $request){
    //
        $service = new service();
        $service ->name=$request->input('name');
        $service->user_id = $request->user()->id;
        $service -> save();

        return response()->json(['success' => true,]);
    }

    public function getService()
    {
        $service = Service::all();
        return response()->json(['success' => true, $service]);
        }

    }

