<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\patients;
use App\Models\managers;
use App\Models\admins;
use App\Models\passwordReset;
use Validator;
use Carbon\Carbon;

class loginController extends Controller
{
 /**
     * patient, manager and admin login.
     */
    public function login(Request $request)
    {

        $rules = array('email'=>'required|email|','password'=>'required|min:8');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $admin   =  admins::where('email',$request['email'])->first();
        $manager =  managers::where('email',$request['email'])->first();
        $patient =  patients::where('email',$request['email'])->first();


        if (!is_null($admin)) {

            $verify = Hash::check($request['password'], $admin->a_password);
            if ($verify == false) {
                return response()->json('invalid credentials', 401);
            }else{
                $token = $admin->createToken($admin->email)->plainTextToken;
                return response()->json(['message'=>'loggedin','data'=>$admin,'token'=>$token],200);
            }


        }else if(!is_null($manager)){

            $verify = Hash::check($request['password'], $manager->m_password);
            if ($verify == false) {
                return response()->json('invalid credentials', 401);
            }else{
                $token = $manager->createToken($manager->email)->plainTextToken;
                return response()->json(['message'=>'loggedin','data'=>$manager,'token'=>$token],200);
            }



        }else if(!is_null($patient)){

            $verify = Hash::check($request['password'], $patient->p_password);
            if ($verify == false) {
                return response()->json('invalid credentials', 401);
            }else{
                $token = $patient->createToken($patient->email)->plainTextToken;
                return response()->json(['message'=>'loggedin', 'data'=>$patient,'token'=>$token],200);
            }
        }else{
            return response()->json('invalid credentials', 401);

        }




    }
    }


    public function logout() {
        auth()->user()->tokens()->delete();
        return response()->json(['status'=>'success', 'message'=>'logged out']);
    }


    public function passwordResetRequest(Request $request) {


        $patient = patients::where('email',$request['email'])->first();
        $manager = managers::where('email',$request['email'])->first();
        if (!is_null($patient)) {

            $email = $patient->email;
            $token = Str::random(64);
$time = Carbon::now()->format('Y-m-d H:i:s');
passwordReset::updateOrInsert(['email'=>$email],['token'=>$token,'email'=>$email,'created_at'=>$time]);

            Mail::send('emails.password_reset', ['token'=>$token], function ($message) use ($email) {
                $message->to($email)->subject('Password Reset');
            });
            return response()->json(['message'=>'password reset link sent on this email'],200);



        }elseif (!is_null($manager)) {
            $email = $manager->email;
            $token = Str::random(64);
$time = Carbon::now()->format('Y-m-d H:i:s');
passwordReset::updateOrInsert(['email'=>$email],['token'=>$token,'email'=>$email,'created_at'=>$time]);

            Mail::send('emails.password_reset', ['token'=>$token], function ($message) use ($email) {
                $message->to($email)->subject('Password Reset');
            });
            return response()->json(['message'=>'password reset link sent on this email'],200);
        }else {

            return response()->json(['message'=>'Invalid Email'],404);
        }


    }


    public function passwordReset(Request $request) {
        $rules = array('password'=>'required|min:8','confirm_password'=>'required|same:password');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{

$resetToken = passwordReset::where('token',$request['token'])->first();
if (is_null($resetToken)) {
    return response()->json(['message'=>'Unauthorized'],404);
}else{

$patient = patients::where('email',$resetToken->email)->first();
$manager = managers::where('email',$resetToken->email)->first();
if (!is_null($patient)) {
    $patient->p_password = Hash::make($request['password']);
    $patient->save();
    $resetToken->delete();
    return response()->json(['message'=>'Your Password is Updated'],200);


}else if (!is_null($manager)) {
    $manager->m_password = Hash::make($request['password']);
    $manager->save();
    $resetToken->delete();
    return response()->json(['message'=>'Your Password is Updated'],200);
}
else {
    return response()->json(['message'=>'User not found'],404);

}

}

}


    }
}