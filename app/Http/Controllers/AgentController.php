<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketReply;
use App\Models\Ticket;
use Exception;
use Illuminate\Support\Facades\Auth;
use DB;

class AgentController extends Controller
{
    public function get_all_tickets(){

        try {

            $datas = DB::table("tickets")
                            ->select(
                                '*',
                    
                            )
                            ->get();

            return compact('datas');

        }
         catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function view_ticket_details($id){

        try{

            $data = DB::table("tickets")
                        ->select('*')
                        ->where('id', $id)
                        ->first();

            return view('agent.view_ticket_details', compact('data'));

        }catch(Exception $ex) {
            return $ex->getMessage();
        }

    }


    public function save_reply(Request $request, $id) {
        try {
            $userID = Auth::id();
            $reply = $request->input('reply');

            $exReply =  DB::table('ticket_replies')
                                ->select('*')
                                ->where('ticket_id', $id)
                                ->first();

            if($exReply){

                $updated = DB::table('ticket_replies')
                            ->where('ticket_id', $id)
                            ->update(['agent_id' => $userID,'reply' => $reply]);

                return response()->json(["status" => "saved", "data" => $updated]);
            }else{
                $ticketReply = new TicketReply();
                $ticketReply->ticket_id = $id;
                $ticketReply->agent_id =  $userID;
                $ticketReply->reply = $reply;
        
                if ($ticketReply->save()) {
                    return response()->json(["status" => "saved", "data" => $ticketReply]);
                } else {
                    return response()->json(["status" => 'failed', "message" => "Failed to save the remark."]);
                }
            }
    
        } catch (Exception $ex) {
            return response()->json(["status" => 'failed', "message" => $ex->getMessage()]);
        }
    }


    public function get_reply($id){

        try{

            $replyData = DB::table("ticket_replies")
                            ->select('ticket_replies.reply', 'tickets.status')
                            ->join('tickets', 'tickets.id', '=', 'ticket_replies.ticket_id')
                            ->where('ticket_replies.ticket_id', $id)
                            ->first();

            return response()->json(["status" => "success", "data" => $replyData]);

        }catch(Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function pending($id)
    {
        try {

            $ticket = Ticket::find($id);
            $ticket->status=0;
            $ticket->update();

            return response()->json(["status" => "success", "data" => $ticket]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function inProgress($id)
    {
        try {

            $ticket = Ticket::find($id);
            $ticket->status=1;
            $ticket->update();

            return response()->json(["status" => "success", "data" => $ticket]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }
    }


    public function resolved($id)
    {
        try {

            $ticket = Ticket::find($id);
            $ticket->status=2;
            $ticket->update();

            return response()->json(["status" => "success", "data" => $ticket]);
        } catch (Exception $ex) {
            return $ex->getMessage();
        }

    }


}
