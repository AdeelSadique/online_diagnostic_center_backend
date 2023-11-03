<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\File;
use Illuminate\Support\Facades\Storage;
use App\models\reports;
use App\models\appointments;
use Validator;

class reportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = reports::all();
        return response()->json(['status'=>'success','data'=>$reports],200);
    }


    public function downloadReport($file)
    {
$report = storage_path('app/reports/'.$file);
if (file_exists($report)) {

    ob_end_clean();
    $headers = ['Content-Type'=>'application/octet-stream','Content-Disposition'=>'attachment; filename="'.$file.'"'];
    return response()->file($report, $headers);
}else{

    return response()->json(['status'=>'error','message'=>'report not found'],404);
}
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



        // $rules = array('r_file'=>'required|file','r_id'=>'required');
        $rules = array();

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $report = reports::find($request['r_id']);

if (is_null($report)) {
    return response()->json(['status'=>'error','message'=>'report not found'],404);
}else{

    //first we save the report in server and then store the url in db

    $file =  $request->file('r_file');
    $ext = $file->getClientOriginalExtension();
    $name = $report->ap_id.'.'.$ext;
    $path = $file->storeAs('reports',$name);

    $report->r_file = $name;

    $appointment =  appointments::find($report->ap_id);
    $appointment->ap_status = 4;
    $appointment->save();

    $report->save();



    return response()->json(['message'=>'created', 'status'=>'200','data'=>$report]);

    if ($result) {

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
        // using this method all tests are available with manager id
        $report = reports::find($id);
if (is_null($report)) {

    return response()->json(['status'=>'error','message'=>'report not found'],404);
}else{
    return response()->json(['status'=>'success','data'=>$report],200);

}

    }


    public function patientReports(string $id)
    {
        $reports = reports::where('p_id',$id)->get();
if (is_null($reports)) {

    return response()->json(['status'=>'error','message'=>'report not found'],404);
}else{
    return response()->json(['status'=>'success','data'=>$reports],200);

}

    }
    public function managerReports(string $id)
    {
        $reports = reports::where('m_id',$id)->get();
if (is_null($reports)) {

    return response()->json(['status'=>'error','message'=>'report not found'],404);
}else{
    return response()->json(['status'=>'success','data'=>$reports],200);

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


        $report = reports::find($id);


        if (is_null($report)) {
            return response()->json([ 'status'=>'error','message'=>'record not found'],404);
        }else{




            $rules = array('r_status'=>'required');

            $validate = Validator::make($request->all(),$rules);

            if ($validate->fails()) {
        return response()->json($validate->errors(), 401);
    }else{

        $report->r_status = $request['r_status'];

          $result = $report->save();

          if ($result) {

            return response()->json([ 'status'=>'success','message'=>'record updated successfully','data'=>$report],200);
        }else{
            return response()->json([ 'status'=>'error','message'=>'failed to update record'],500);

        }



    }


    }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $report = reports::find($id);

        if (is_null($report)) {
            return response()->json([ 'status'=>'error','message'=>'record not found'],404);
        }else{
            $result = $report->delete();
            if ($result) {
                return response()->json([ 'status'=>'success','message'=>'record has been deleted'],200);

            }else{
                return response()->json([ 'status'=>'error','message'=>'failed to delete record'],500);

            }

        }




    }
}