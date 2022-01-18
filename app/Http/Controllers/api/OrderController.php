<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Ord;

class OrderController extends Controller
{
    //
   public function OrderList(Request $request)
    {
        $order = new Ord();
        $order ->duration=$request->input('duration');
        $order ->buyer_id = $request->user()->id;
        $order ->buyerName = $request->user()->first_name;
        $validator = Validator::make($request->email, [
        'email' => 'required|email|unique:users,email'
                        ]);
                        $validator->after(function ($validator) use ($request) {
                            if (User::where('email', $request->input('email'))->exists()) {
                                $validator->errors()->add('email', 'There exists an invite with this email!');
                            }
                        });
                        if ($validator->fails()) {
                            return redirect(route(''))
                                ->withErrors($validator)
                                ->withInput();
                        }
                        do {
                            $token = Str::random(20);
                        } while (User::where('token', $token)->first());
                        User::create([
                            'token' => $token,
                            'email' => $request->input('email')
                        ]);
                        $url = URL::temporarySignedRoute(   
                            'registration', now()->addMinutes(300), ['token' => $token]
                        );     
                        $order -> save();
                        return response()->json(['success' => true, $order]);
                    }
    }
