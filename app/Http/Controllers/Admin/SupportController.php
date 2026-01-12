<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\TicketChat;
use App\Models\User;
use App\Mail\TicketSentUser;

class SupportController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
    	$support = Tickets::index();

    	return view('support.list',[
    		'tickets' => $support]);
    }

    public function reply($id)
    {
        $id =\Crypt::decrypt($id);
        $ticket = Tickets::on('mysql2')->where('id',$id)->first();
        if(!is_object($ticket)){
            return back()->with('status',"Invalid ticket!"); 
        }
        $chatlist=TicketChat::on('mysql2')->where('ticketid',$ticket->ticket_id)->get();
        TicketChat::where('ticketid',$ticket->ticket_id)->update(['admin_status' => 1]);
        
        $userid = $ticket->uid;
        $userlist = User::where('id',$userid)->first();

        return view('support.reply', [
            'chatlist' => $chatlist,
            'username' => $userlist->name,
            'userlist' => $userlist
        ]);
    }

    public function adminsavechat(Request $request)
    {

        $message     = $request->message;
        $chat_id     = $request->chat_id;
        $userid       = $request->userid;
        $ticket = Tickets::on('mysql2')->where('ticket_id',$chat_id)->first();
        if(!is_object($ticket)){
            return back()->with('status',"Invalid ticket!"); 
        }
        if($message !="" && $chat_id !="" && $userid  !="")
        {

            $ticketChat = new TicketChat;
            $ticketChat->uid = $userid;
            $ticketChat->ticketid = $chat_id;
            $ticketChat->message = NULL;
            $ticketChat->reply = $message;
            $ticketChat->user_status = 0;
            $ticketChat->admin_status = 1;

            if ($ticketChat->save())
            {
                TicketChat::where('ticketid',$chat_id)->update(['admin_status' => 1]);
                $userEmail = User::where('id', $userid)->first();
                $email =$userEmail->email;
                \Mail::to($email)->queue(new TicketSentUser($chat_id, $userid, $ticketChat));
                $data['msg'] = 'success';
            }
            else
            {
                $data['msg'] = 'fail';
            }   
        }
        else
        {
            $data['msg'] = 'required';
        } 
        return json_encode($data);

    }
}
