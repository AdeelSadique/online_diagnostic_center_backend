<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\feedbacks;
use Validator;

class feedbackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feedback = feedbacks::all();
        return response()->json(['status'=>'success', 'data'=>$feedback],200);
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
        $rules = array('ap_id'=>'required','feedback'=>'required');

        $validate = Validator::make($request->all(),$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{


            $feedback = new feedbacks;



            $feedback->ap_id = $request['ap_id'];
            $feedback->feedback = $request['feedback'];

    $result = $feedback->save();

        if ($result) {

            return response()->json(['status'=>'success','message'=>'created','data'=>$feedback],201);
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
        $feedback = feedbacks::find($id);

        if (is_null($feedback)) {
            return response()->json(['status'=>'error','message'=>'feedback not found'],404);
        }else{


                return response()->json(['status'=>'success','data'=>$feedback],200);


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


        $rules = array('reply'=>'required');

        $validate = Validator::make($request->all(),$rules);

        if ($validate->fails()) {
            return response()->json($validate->errors(), 401);
        }else{



        $feedback = feedbacks::where('ap_id',$id)->first();
        if (is_null($feedback)) {
            return response()->json(['status'=>'error','message'=>'feedback not found'],404);
        }else{
            $feedback->reply = $request['reply'];
            $result = $feedback->save();
            if ($result) {

                return response()->json(['status'=>'success','message'=>'updated'],200);
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
        $feedback = feedbacks::find($id);

        if (is_null($feedback)) {
            return response()->json(['status'=>'error','message'=>'feedback not found'],404);
        }else{
            $result = $feedback->delete();
            return response()->json(['status'=>'success','message'=>'record has been updated deleted'],200);


        }
    }
}