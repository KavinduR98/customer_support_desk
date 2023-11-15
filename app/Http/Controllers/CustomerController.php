<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Exception;
use DB;
use Illuminate\Support\Str; 

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer.view_customer_ticket');
    }


    public function save_data(Request $request)
    {

        try {

            $ticket = new Ticket();
            $ticket->customer_name = $request->get('customer_name');
            $ticket->problem = $request->get('customer_problem');
            $ticket->email = $request->get('customer_email');
            $ticket->phone_number = $request->get('customer_phone');
            $ticket->status = 0;

            // Generate a UUID for the reference number
            $uuid = Str::uuid();

            $ticket->reference_number = $uuid;

            if($ticket->save()) {
                return response()->json(["status" => "saved", "data" => $ticket]);
            } else {
                return response()->json(["status" => "failed"]);
            }

        } catch(Exception $ex) {
            return $ex;
        }
    }


    public function check_ticket_info(Request $request){

       try{

            $ref_no = $request->get('ref_no');

            $ticket_data = DB::table("tickets")
                                ->select(
                                    'reference_number',
                                    'customer_name',
                                    'status'
                                )
                                ->where('reference_number', $ref_no)
                                ->first();


            return compact('ticket_data');

       }catch(Exception $ex) {
            return $ex;
        }

    }


}
