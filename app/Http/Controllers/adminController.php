<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\models\admins;
use Validator;

class adminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $admin = admins::find($id);
       return response()->json(['status'=>'success','data'=>$admin], 200);
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
        $rules = array('name'=>'required','email'=>'required|email|unique:admins,email','contact'=>'required|min:11|max:11','gender'=>'required','dob'=>'required','address'=>'required','password'=>'required|min:8|','confirm_password'=>'same:password',);

        $validate = Validator::make($request->all(),$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{


        $admin = new admins;



        $admin->name = $request['name'];
        $admin->email = $request['email'];
        $admin->a_contact = $request['contact'];
        $admin->a_gender = $request['gender'];

        $date = date_create($request['dob']);
        $admin->a_dob = date_format($date,'Y/m/d');

        $admin->a_address = $request['address'];
        $admin->a_password = Hash::make($request['password']);
        $admin->user_type = '2';
        $result = $admin->save();
        if ($result) {


            return response()->json(['message'=>'created', 'status'=>'200','data'=>$admin]);
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
        $admin = admins::find($id);
if (is_null($admin)) {

    return response()->json(['status'=>'error','message'=>'User not found'], 404);
}else{

    return response()->json(['status'=>'success','data'=>$admin], 200);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}