<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\billings;
use App\models\appointments;

class billingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bill = billings::all();
        return response()->json(['data'=>$bill],200);
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $billing = billings::find($id);
        if (is_null($billing)) {
          return response()->json(['status'=>'error', 'message'=>'bill not found'],404);
        }else{
            return response()->json([ 'data'=>$billing],200);
        }
    }


    public function managerBills(string $id)
    {
        $billing = billings::where('m_id',$id)->get();
        if (is_null($billing)) {
          return response()->json(['status'=>'error', 'message'=>'bill not found'],404);
        }else{
            return response()->json(['data'=>$billing],200);
        }
    }
    // public function patientBill(string $id)
    // {
    //     $bill = billings::where('ap_id',$id)->first();
    //     if (is_null($bill)) {
    //       return response()->json(['status'=>'error', 'message'=>'bill not found'],404);
    //     }else{
    //         return response()->json(['status'=>'success', 'data'=>$bill],200);
    //     }
    // }

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
        $bill = billings::where('ap_id',$id)->first();

        if (is_null($bill)) {
            return response()->json(['message'=>'bill not found'],404);
        }else{

if ($request['b_status'] == 1) {



            $bill->b_status = $request['b_status'];
            $appointment = appointments::find($bill->ap_id);
             $appointment->b_status =  $request['b_status'];
             $appointment->ap_status = 3;
            $appointment->save();


            $result = $bill->save();
            if ($result) {

                return response()->json(['message'=>'updated','data'=>$bill],200);
            }else{
                return response()->json(['message'=>'failed to update'],500);

            }
        }elseif ($request['b_staus'] == 0) {

            $bill->b_status = $request['b_status'];
            $appointment = appointments::find($bill->ap_id);
             $appointment->b_status =  $request['b_status'];
             $appointment->ap_status = 1;
            $appointment->save();


            $result = $bill->save();
            if ($result) {

                return response()->json(['message'=>'updated','data'=>$bill],200);
            }else{
                return response()->json(['message'=>'failed to update'],500);

            }

        }


        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bill = billings::find($id);

        if (is_null($bill)) {
            return response()->json(['message'=>'appointment do not exist'],404);
        }else{
            $result = $bill->delete();
            return response()->json(['message'=>'record has been updated deleted'],200);


        }
    }
}
