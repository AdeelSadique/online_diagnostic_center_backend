<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\adminMessages;
use Illuminate\Support\Facades\Mail;
use Validator;

class adminMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $adminMessage = adminMessages::all();
        return response()->json(['status'=>'success', 'data'=>$adminMessage],200);
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
        $rules = array('name'=>'required','email'=>'required|email','contact'=>'required|min:11|max:11','message'=>'required');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $adminMessage = new adminMessages;



        $adminMessage->name = $request['name'];
        $adminMessage->email = $request['email'];
        $adminMessage->contact = $request['contact'];
        $adminMessage->message = $request['message'];

        $result = $adminMessage->save();

        if ($result) {

            return response()->json(['status'=>'success','message'=>'created','data'=>$adminMessage],201);
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
        $adminMessage = adminMessages::find($id);

        if (is_null($adminMessage)) {
            return response()->json(['status'=>'error','message'=>'Message not found'],404);
        }else{


                return response()->json(['status'=>'success','data'=>$adminMessage],200);


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
        $adminMessage = adminMessages::find($id);

        if (is_null($adminMessage)) {
            return response()->json(['status'=>'error','message'=>'message not found'],404);
        }else{


            $rules = array('reply'=>'required');

            $validate = Validator::make($request->all(),$rules);

            if ($validate->fails()) {
        return response()->json($validate->errors(), 401);
    }else{


            $userEmail = $adminMessage->email;
            $data =$request['reply'];

            Mail::send('emails.admin_reply', ['data'=>$data], function ($message) use ($userEmail) {
                $message->to($userEmail)->subject('admin@fasttest.com');
            });

            $adminMessage->reply = $request['reply'];
            $result = $adminMessage->save();
            if ($result) {

                return response()->json(['message'=>'updated'],200);
            }else{
                return response()->json(['status'=>'error','message'=>'failed to update'],500);

            }
        }

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $adminMessage = adminMessages::find($id);

        if (is_null($adminMessage)) {
            return response()->json(['status'=>'error','message'=>'message not found'],404);
        }else{
            $result = $adminMessage->delete();
            return response()->json(['status'=>'success','message'=>'record has been updated deleted'],200);


        }
    }
}