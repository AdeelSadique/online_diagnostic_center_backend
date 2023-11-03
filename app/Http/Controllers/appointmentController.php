<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\appointments;
use App\models\reports;
use App\models\billings;
use Validator;

class appointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $allAppointments = appointments::all();
        return response()->json(['data'=>$allAppointments],200);
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

        $rules = array('p_id'=>'required','t_id'=>'required','ap_type'=>'required','ap_date'=>'required','b_amount'=>'required','m_id'=>'required');

        $validate = Validator::make($request->all(),$rules);

if ($validate->fails()) {
    return response()->json($validate->errors(), 401);
}else{


        $appointment = new appointments;




        $appointment->p_id = $request['p_id'];
        $appointment->t_id = $request['t_id'];
        $appointment->m_id = $request['m_id'];


        // 0 for pending 1 for accept 2 for rejected 3 for analyzing 4 for conducted
        $appointment->ap_status = 0;

        $appointment->ap_type = $request['ap_type'];
        $date = date_create($request['ap_date']);
        $appointment->ap_date = date_format($date,'Y/m/d');





        $result = $appointment->save();
        $report = new reports;
        $billing = new billings;
        $billing->b_amount = $request['b_amount'];
        $billing->m_id = $request['m_id'];
        $billing->b_status = 0;

        $report->ap_id = $appointment->ap_id;
        $report->p_id = $request['p_id'];
        $report->m_id = $request['m_id'];
        $billing->ap_id = $appointment->ap_id;


        $report->r_status = 0;
        $billing->save();
        $report->save();




        if ($result) {

            return response()->json(['message'=>'created'],201);
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
        // using this method only those tests available who related with specific manager
      $managerAppointments = appointments::where('m_id',$id)->get();
      return response()->json(['data'=>$managerAppointments],200);
    }

    public function patientAppointments(string $id)
    {
        $appointments = appointments::where('p_id',$id)->get();
        if (is_null($appointments)) {
            return response()->json('Not any appointment', 404);
        }else{
            return response()->json(['data'=>$appointments], 200);

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
        $appointment = appointments::find($id);

        if (is_null($appointment)) {
            return response()->json(['message'=>'appointment do not exist'],404);
        }else{






 $appointment->ap_status = $request['ap_status'];
    $result = $appointment->save();



    if ($result) {


        return response()->json(['message'=>'updated','data'=>$appointment],200);
    }else{
        return response()->json(['message'=>'failed to update'],500);

    }






        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $appointment = appointments::find($id);

        if (is_null($appointment)) {
            return response()->json(['message'=>'appointment do not exist'],404);
        }else{

$report = reports::where('ap_id',$id)->first();
$billing = billings::where('ap_id',$id)->first();
$report->delete();
$billing->delete();



            $result = $appointment->delete();
            return response()->json(['message'=>'record has been updated deleted'],200);


        }
    }
}
