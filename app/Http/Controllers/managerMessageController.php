<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\managerMessages;
use Validator;

class managerMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managerMessage = managerMessages::all();
        return response()->json(['status'=>'success', 'data'=>$managerMessage],200);
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
        $rules = array('m_id'=>'required','p_id'=>'required','message'=>'required');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $managerMessage = new managerMessages;



        $managerMessage->message = $request['message'];
        $managerMessage->m_id = $request['m_id'];
        $managerMessage->p_id = $request['p_id'];

        $result = $managerMessage->save();

        if ($result) {

            return response()->json(['status'=>'success','message'=>'created','data'=>$managerMessage],201);
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
        $managerMessage = managerMessages::find($id);

        if (is_null($managerMessage)) {
            return response()->json(['status'=>'error','message'=>'Message not found'],404);
        }else{


                return response()->json(['status'=>'success','data'=>$managerMessage],200);


        }

    }




    public function patientMessage(Request $request, string $id)
    {
        $patientMessages = managerMessages::where('p_id',$id)->orderby('mm_id','ASC')->get();

        if (is_null($patientMessages)) {
            return response()->json(['status'=>'error','message'=>'Message not found'],404);
        }else{


                return response()->json(['data'=>$patientMessages],200);


        }

    }
    public function managerMessages(Request $request, string $id)
    {
        $managerMessages = managerMessages::where('m_id',$id)->get();

        if (is_null($managerMessages)) {
            return response()->json(['status'=>'error','message'=>'Message not found'],404);
        }else{


                return response()->json(['data'=>$managerMessages],200);


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
        $managerMessage = managerMessages::find($id);

        if (is_null($managerMessage)) {
            return response()->json(['status'=>'error','message'=>'message not found'],404);
        }else{
            $managerMessage->reply = $request['reply'];
            $result = $managerMessage->save();
            if ($result) {

                return response()->json(['status'=>'success','message'=>'updated','data'=>$managerMessage],200);
            }else{
                return response()->json(['status'=>'error','message'=>'failed to update'],500);

            }

        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $managerMessage = managerMessages::find($id);

        if (is_null($managerMessage)) {
            return response()->json(['status'=>'error','message'=>'message not found'],404);
        }else{
            $result = $managerMessage->delete();
            return response()->json(['status'=>'success','message'=>'record has been updated deleted'],200);


        }
    }
}