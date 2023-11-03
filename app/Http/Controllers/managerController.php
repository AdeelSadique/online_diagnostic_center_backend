<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\managers;
use App\Models\tests;
use Validator;

class managerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $managers = managers::all();
        return response()->json(['data'=>$managers]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array('name'=>'required','hospital_name'=>'required','email'=>'required|email|unique:managers,email','contact'=>'required|min:11|max:11','address'=>'required','password'=>'required|min:8|','confirm_password'=>'same:password',);

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $manager = new managers;



        $manager->name = $request['name'];
        $manager->email = $request['email'];
        $manager->hospital_name = $request['hospital_name'];
        $manager->m_contact = $request['contact'];
        $manager->m_address = $request['address'];
        $manager->user_type = '1';
        $manager->status = 0;
        $manager->m_password = Hash::make($request['password']);
        $result = $manager->save();

        if ($result) {

            $token = $manager->createToken($manager->email)->plainTextToken;

            return response()->json(['message'=>'created', 'status'=>'200','data'=>$manager,'token'=>$token]);
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
        $manager = managers::find($id);
        if (!is_null($manager)) {
            return response()->json(['status'=>'success','data'=>$manager]);
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

        $rules = array('name'=>'nullable','email'=>'nullable|email|unique:managers,email','m_contact'=>'nullable','m_address'=>'nullable','m_password'=>'nullable','hospital_name'=>'nullable','status'=>'nullable');
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{

//manager 0 for pending 1 for accept 2 for reject 3 for terminate service
            $manager = managers::find($id);

            if (is_null($manager)) {
                return response()->json([ 'status'=>'error','message'=>'manager not found'],401);
            }else{

                if ($request['status']==3) {
                    $test = tests::where('m_id',$id)->get();

                    if (!is_null($test)) {

                        foreach ($test as $tests) {
                            $tests->t_status = 0;

                            $tests->update();
                        }
                        $result = $manager->update($request->all());

                    if ($result) {
                        return response()->json([ 'status'=>'success','message'=>'updated'],200);
                    }else{
                        return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                    }
                    }else{


                    $result = $manager->save($request->all());
                    if ($result) {
                        return response()->json([ 'status'=>'success','message'=>'updated'],200);
                    }else{
                        return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                    }
                    }


                }elseif ($request['status']==1) {
                    $test = tests::where('m_id',$id)->get();

                    if (!is_null($test)) {
                        foreach ($test as $tests) {
                            $tests->t_status = 1;

                            $tests->update();
                        }
                        $result = $manager->update($request->all());
                    if ($result) {
                        return response()->json([ 'status'=>'success','message'=>'updated'],200);
                    }else{
                        return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                    }
                    }else{
                        $result = $manager->update($request->all());
                    if ($result) {
                        return response()->json([ 'status'=>'success','message'=>'updated'],200);
                    }else{
                        return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                    }
                    }






                }else{


                    $result = $manager->update($request->all());
                    if ($result) {
                        return response()->json([ 'status'=>'success','message'=>'updated'],200);
                    }else{
                        return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

                    }



                }

        }
    }
    }

    public function updatePassword(Request $request, string $id)
    {

        $rules = array('m_password'=>'required|min:8',);
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{
            $manager = managers::find($id);
            if (is_null($manager)) {
                return response()->json([ 'status'=>'error','message'=>'manager not found'],401);
            }else{

                    $manager->m_password = Hash::make($request['m_password']);
                    $result = $manager->save();
            if ($result) {
                return response()->json([ 'status'=>'success','message'=>'updated'],200);
            }else{
                return response()->json([ 'status'=>'error','message'=>'something went wrong'],401);

            }
}
        }
    }

    public function changePassword(Request $request, string $id)
    {
        $rules = array('old_password'=>'required|min:8','new_password'=>'required|min:8','confirm_password'=>'required|same:new_password');
        $validate = Validator::make($request->all(),$rules);
        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{
            $manager = managers::find($id);
            if (is_null($manager)) {
                return response()->json([ 'status'=>'error','message'=>'patient not found'],401);
            }else{


                if (!Hash::check($request['old_password'], $manager->m_password)) {
                    return response()->json(['invalid'=>'Old password is invalid'],401);
                }else{

                    if ($request['old_password'] == $request['new_password']) {
                        return response()->json(['same'=>'Old and New Password must be different'],401);
                    }else{


                        $manager->m_password = Hash::make($request['new_password']);
                        $result = $manager->save();
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
        $manager = managers::find($id);
        if (!is_null($manager)) {

            $test = tests::where('m_id',$id)->get();

            if (!is_null($test)) {

                foreach ($test as $tests) {
                    $tests->delete();
                }}


            $manager->delete();
            return response()->json(['status'=>'success','message'=>'Record has been deleted'],200);
        }else{
            return response()->json([ 'status'=>'error','message'=>'failed to delete record'],500);

            }
    }
}