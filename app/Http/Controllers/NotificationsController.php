<?php

namespace App\Http\Controllers;

use App\Notification;
use Auth;
use App\User;

use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $nots = Auth::user()->notifications;

        foreach($nots as $not){
            if($not->status == 'Unseen'){
                $not->status = 'Seen';
                $not->save();
            }
        }

        return view('notifications/index')->with('nots', $nots);
    }

    public function hide(request $request){
        $not = Notification::find($request['not_id']);
        $not->delete();

        return redirect('notifications');
    }
}
