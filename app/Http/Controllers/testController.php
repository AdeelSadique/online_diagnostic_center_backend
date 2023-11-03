<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\managers;
use App\models\tests;
use Validator;

class testController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {



        $tests = tests::all();
        return response()->json(['data'=>$tests]);
        // or
        // $tests = tests::with('managerForiegnFunc')->get();
        // return response()->json(['data'=>$tests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = array('t_name'=>'required','t_category'=>'required','t_price'=>'required','reporting_time'=>'required','t_location'=>'required','m_id'=>'required');

        $validate = Validator::make($request->all(),$rules);
if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $test = new tests;

        $test->m_id = $request['m_id'];
        $test->t_name = $request['t_name'];
        $test->t_category = $request['t_category'];
        $test->t_price = $request['t_price'];
        $test->reporting_time = $request['reporting_time'];
        $test->t_location = $request['t_location'];

        $result = $test->save();



        if ($result) {



            return response()->json([ 'data'=>$test],201);
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
        $test = tests::find($id);

if (is_null($test)) {

    return response()->json(['data'=>'tests not found'],404);
}else{

    return response()->json(['data'=>$test],200);
}

    }


    public function managerTests(string $id)
    {
        // using this method all tests are available with manager id

        $managerTests = tests::where('m_id',$id)->get();
        if (is_null($managerTests)) {

            return response()->json(['data'=>'tests not found'],404);
        }else{

            return response()->json(['data'=>$managerTests],200);
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
        $test = tests::find($id);

        if (is_null($test)) {
            return response()->json([ 'message'=>'record not found','data'=>$test],404);
        }else{


            $result = $test->update($request->all());

        if ($result) {

            return response()->json([ 'message'=>'record updated successfully','data'=>$test]);
        }else{
            return response()->json([ 'message'=>'failed to update record'],401);

        }


    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $test = tests::find($id);

        if (is_null($test)) {
            return response()->json(['message'=>'record not found','data'=>$test],404);
        }else{
            $result = $test->delete();
            if ($result) {
                return response()->json(['message'=>'record has been deleted'],200);

            }else{
                return response()->json([ 'message'=>'failed to delete record'],401);

            }

        }
    }
}