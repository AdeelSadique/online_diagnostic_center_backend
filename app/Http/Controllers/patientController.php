<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\patients;
use Validator;

class patientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $patients = patients::all();
        return response()->json(['data'=>$patients], 200);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $rules = array('name'=>'required','email'=>'required|email|unique:patients,email','contact'=>'required|min:11|max:11','gender'=>'required','dob'=>'required','address'=>'required','password'=>'required|min:8|','confirm_password'=>'required|same:password',);

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $patient = new patients;



        $patient->name = $request['name'];
        $patient->email = $request['email'];
        $patient->p_contact = $request['contact'];
        $patient->p_blood = $request['blood'];
        $patient->p_gender = $request['gender'];

        $date = date_create($request['dob']);
        $patient->p_dob = date_format($date,'Y/m/d');

        $patient->p_address = $request['address'];
        $patient->p_password = Hash::make($request['password']);
        $patient->user_type = '0';
        $result = $patient->save();
        if ($result) {

            $token = $patient->createToken($patient->email)->plainTextToken;

            return response()->json(['data'=>$patient,'token'=>$token],201);
        }else{
            return response()->json('failed to insert', 401);
        }
    }
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $patient = patients::find($id);
if (!is_null($patient)) {
    return response()->json(['status'=>'success','data'=>$patient]);
}else{
    return response()->json([ 'status'=>'error','message'=>'patient do not exist']);

    }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {


        $rules = array('name'=>'nullable','p_contact'=>'nullable|min:11','p_address'=>'nullable','p_password'=>'nullable|min:8','p_blood'=>'nullable','p_gender'=>'nullable');
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{


            $patient = patients::find($id);

            if (is_null($patient)) {
                return response()->json([ 'status'=>'error','message'=>'manager not found'],401);
            }else{


                $result = $patient->update($request->all());


            if ($result) {

                return response()->json([ 'status'=>'created','data'=>$patient],200);
            }else{
                return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

            }
}
}


}
//this is for admin to change password
    public function updatePassword(Request $request, string $id)
    {


        $rules = array('p_password'=>'required|min:8');
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{
            $patient = patients::find($id);
            if (is_null($patient)) {
                return response()->json([ 'status'=>'error','message'=>'manager not found'],401);
            }else{

                    $patient->p_password = Hash::make($request['p_password']);
                    $result = $patient->save();
            if ($result) {
                return response()->json(['message'=>'password updated'],200);
            }else{
                return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

            }
}
        }

    }

    //this is for patient to change password
    public function changePassword(Request $request, string $id)
    {


        $rules = array('old_password'=>'required|min:8','new_password'=>'required|min:8','confirm_password'=>'required|same:new_password');
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{
            $patient = patients::find($id);
            if (is_null($patient)) {
                return response()->json([ 'status'=>'error','message'=>'patient not found'],401);
            }else{


                if (!Hash::check($request['old_password'], $patient->p_password)) {
                    return response()->json(['invalid'=>'Old password is invalid'],401);
                }else{

                    if ($request['old_password'] == $request['new_password']) {
                        return response()->json(['same'=>'Old and New Password must be different'],401);
                    }else{


                        $patient->p_password = Hash::make($request['new_password']);
                        $result = $patient->save();
                        if ($result) {
                            return response()->json(['message'=>'password updated'],200);
                        }else{
                            return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                        }
}
}




}
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

$patient = patients::find($id);
if (!is_null($patient)) {
    $patient->delete();
    return response()->json(['status'=>'success','message'=>'Record has been deleted'],200);
}else{
    return response()->json([ 'status'=>'error','message'=>'failed to delete record'],500);

    }


    }
}