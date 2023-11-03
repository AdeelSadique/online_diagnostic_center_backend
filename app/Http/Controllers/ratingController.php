<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\ratings;
use App\models\feedbacks;
use Validator;

class ratingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rating = ratings::all();
        return response()->json(['status'=>'success', 'data'=>$rating],200);
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
        $rules = array('p_id'=>'required','t_id'=>'required','ap_id'=>'required','rating'=>'required','feedback'=>'required','m_id'=>'required');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{



$rating = ratings::where('ap_id',$request['ap_id'])->first();

if (!is_null($rating)) {
    $rating->rating = $request['rating'];

$feedback =  feedbacks::where('ap_id',$request['ap_id'])->first();
$feedback->feedback = $request['feedback'];
$feedback->save();

   $result =  $rating->save();

    if ($result) {

        return response()->json(['status'=>'success','message'=>'created','data'=>$rating],201);
    }else{
        return response()->json('failed to insert', 401);
    }



}else{


    $rating = new ratings;



    $rating->p_id = $request['p_id'];
    $rating->t_id = $request['t_id'];
    $rating->ap_id = $request['ap_id'];
    $rating->rating = $request['rating'];

    $feedback = new feedbacks;
    $feedback->ap_id = $request['ap_id'];
    $feedback->feedback = $request['feedback'];

    $feedback->save();

    $result = $rating->save();

    if ($result) {

        return response()->json(['status'=>'success','message'=>'created','data'=>$rating],201);
    }else{
        return response()->json('failed to insert', 401);
    }

}
}
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $rating = ratings::where('t_id',$id)->get();

        if (is_null($rating)) {
            return response()->json(['status'=>'error','message'=>'rating not found'],404);
        }else{


                return response()->json(['status'=>'success','data'=>$rating],200);


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
        $rating = ratings::find($id);

        if (is_null($rating)) {
            return response()->json(['status'=>'error','message'=>'rating not found'],404);
        }else{
            $rating->rating = $request['rating'];
            $result = $rating->save();
            if ($result) {

                return response()->json(['status'=>'success','message'=>'updated','data'=>$rating],200);
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
        $rating = ratings::find($id);

        if (is_null($rating)) {
            return response()->json(['status'=>'error','message'=>'rating not found'],404);
        }else{
            $result = $rating->delete();
            return response()->json(['status'=>'success','message'=>'record has been updated deleted'],200);


        }
    }
}
