<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Chat;
use Auth;

class ChatController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::where(function($query){
            $query->where('user_1_id', Auth::user()->id)->
            orwhere('user_2_id', Auth::user()->id);
        })
        ->where('status', 'Approved')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('chat.index')->with('chats', $chats);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if($request['chat_id'] == null){
            return redirect('/');
        }

        $chat = Chat::find($request['chat_id']);

        if($chat->user_1_id != Auth::user()->id){
            $reciever_id = $chat->user1->id;
        }
        else{
            $reciever_id = $chat->user2->id;
        }

        $msg = new Message();
        $msg->sender_id = Auth::user()->id;
        $msg->reciever_id = $reciever_id;
        $msg->chat_id = $request['chat_id'];
        $msg->body = $request['body'];
        $msg->save();

        $chat->last_message_id = $msg->id;
        $chat->save();

        return Message::where('id', $msg->id)->first();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = Chat::find($id);
        if(Auth::user()->id != $chat->user_1_id && Auth::user()->id != $chat->user_2_id){
            return redirect('/');
        }

        $unseen_msgs = Message::where('chat_id', $id)->where('reciever_id', Auth::user()->id)->where('status', 'Unseen')->get();
        foreach($unseen_msgs as $msg){
            $msg->status = 'Seen';
            $msg->save();
        }

        $messages = Message::where('chat_id', $id)->limit(20)->get();
        if(count($messages) > 0){
            return $messages;
        }
        else{
            return "No Messages yet";
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
