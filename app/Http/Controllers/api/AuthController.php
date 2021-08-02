<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

use App\User;

class AuthController extends Controller
{
    //

    public function register(Request $request){
        $request->validate([
           'name' => 'required|string',
            'email' => 'required|string|unique:users',
            'password' => 'required| min:6| max:10 |confirmed',
          
        ]);

        $user = new User([
           'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)

        ]);

        $user->save();
        return response()->json(['message' => 'user has been registered'], 200);       
}

//login function

    public function login(Request $request)
    {
        $request-> validate([
            'email' => 'required|string',
            'password' => 'required|string',
            'remember' => 'boolean'
            
        ]);

        $login = request(['email', 'password']);

        if(!Auth::attempt($login))
        {
            return response(['message'=> 'Invalid login credentials'], 401);
        }

        $user = $request->user();
        $accessToken = $user->createToken('Personal Access Token');
        $token = $accessToken->token;
        $token ->expires_at = Carbon::now()->addWeeks(1);
        $token->save();

        return response()->json(['data'=>[
            'user' => Auth::user(),
            'access_token' => $accessToken->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse($accessToken->token->expires_at)->toDateTimeString()
        ]]);
    }
    //logout function

    public function logout() {

        if(Auth::check()) {
            Auth::user()->token()->revoke();
            return response()->json(["status" => "success", "error" => false, "message" => "Success! You are logged out."], 200);
        }
        return response()->json(["status" => "failed", "error" => true, "message" => "Failed! You are already logged out."], 403);
    }

    public function details() {
        try {
            $user = Auth::user();
            return response()->json(["status" => "success", "error" => false, "data" => $user], 200);
        }
        catch(NotFoundHttpException $exception) {
            return response()->json(["status" => "failed", "error" => $exception], 401);
        }
    }

public function updateProfile(Request $request){
    try {
            $validator = Validator::make($request->all(),[
            'first_name' => 'required|min:2|max:45',
            'last_name' => 'required|min:2|max:45',
            'other_name' => 'required|min:2|max:45',
            'phone' => 'required',
            'address' => 'required|min:2|max:200',
            'state' => 'required',
            'local_government' => '',
            'profile_picture' => 'nullable|image'
        ]);
            if($validator->fails()){
                $error = $validator->errors()->all()[0];
                return response()->json(['status'=>'false', 'message'=>$error, 'data'=>[]],422);
            }else{
                //$user = User::whereEmail($request->email)->first();
                $user = user::find($request->user()->id);
                //dd($request);
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->phone = preg_replace('/^0/','+234',$request->phone);
                $user->other_name = $request->other_name;
                $user->address = $request->address;
                $user->state = $request->state;
                $user->local_government = $request->local_government;

                if($request->profile_picture && $request->profile_picture->isValid())

                {
                    $file_name = time().'.'.$request->profile_picture->extension();
                    $request->profile_picture->move(public_path('images'),$file_name);
                    $path = "public/images/$file_name";
                    $user->profile_picture = $path;
                }
                        $user->update();
                        return response()->json(['status'=>'true', 'message'=>"profile updated suuccessfully", 'data'=>$user]);
            }

    }catch (\Exception $e){
                return response()->json(['status'=>'false', 'message'=>$e->getMessage(), 'data'=>[]], 500);
    }
}

public function all()
{
    return User::all();
}

}
