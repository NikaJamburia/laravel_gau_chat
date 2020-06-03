<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Message;
use App\Chat;
use App\Notification;
use Auth;

class FriendsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $friends = Chat::where(function($query){
            $query->where('user_1_id', Auth::user()->id)->
            orwhere('user_2_id', Auth::user()->id);
        })
        ->where('status', 'Approved')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $friend_requests = Chat::where('user_2_id', Auth::user()->id)->where('status', 'Unapproved')->get();

        return view('friends.index')->with('friends', $friends)->with('friend_requests', $friend_requests);

    }

    public function sendRequest($id){
        $chats = Chat::where('user_1_id', $id)
            ->where('user_2_id', Auth::user()->id)
            ->orwhere('user_1_id', Auth::user()->id)
            ->where('user_2_id', $id)
            ->get();

        if(count($chats) > 0){
            return "NotSent";
        }
        else{
            $chat = new Chat();
            $chat->user_1_id = Auth::user()->id;
            $chat->user_2_id = $id;
            $chat->last_message_id = 15;

            $chat->save();

            $not = new Notification();
            $not->type = 'friendRequest';
            $not->body = "The user <b>".Auth::user()->name."</b> Has sent you a friend request";
            $not->link = "/friends?action=req";
            $not->user_id = $id;
            $not->save();

            return "Sent";
        }
    }

    public function acceptRequest(request $request){
        $chat = Chat::find($request['chat_id']);
        $chat->status = "Approved";
        $chat->save();

        $not = new Notification();
        $not->type = 'friendRequestAccepted';
        $not->body = "The user <b>".Chat::find($request['chat_id'])->user2->name."</b> Has accepted your friend request";
        $not->link = "/chat";
        $not->user_id = $chat->user_1_id;
        $not->save();

        return redirect('friends');
    }

    public function declineRequest(request $request){
        $chat = Chat::find($request['chat_id']);
        
        $not = new Notification();
        $not->type = 'friendRequestDeclined';
        $not->body = "The user <b>".Chat::find($request['chat_id'])->user2->name."</b> Has declined your friend request";
        $not->link = "/friends?action=add";
        $not->user_id = $chat->user_1_id;
        $not->save();
        
        $chat->delete();

        return redirect('friends');
    }

    public function searchByName($name){
        $users = User::where('name', 'LIKE', "%$name%")->where('id', '!=', Auth::user()->id)->get();

        foreach($users as $user){
            $chats = Chat::where('user_1_id', $user->id)
                        ->where('user_2_id', Auth::user()->id)
                        ->orwhere('user_1_id', Auth::user()->id)
                        ->where('user_2_id', $user->id)
                        ->get();

            if(count($chats) > 0){
                $user->status = "AlreadyExists";

                foreach($chats as $chat){
                    if($chat->status == 'Unapproved' && $chat->user1->id == Auth::user()->id){
                        $user->status = "requestExists";
                        break;
                    }
                }
                
                
            }
            else{
                $user->status = "notExists";
            }
        }

        return json_encode($users);
    }
}
