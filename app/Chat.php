<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function user1(){
        return $this->belongsTo('App\User', 'user_1_id');
    }

    public function user2(){
        return $this->belongsTo('App\User', 'user_2_id');
    }
    public function last_message(){
        return $this->belongsTo('App\Message',);
    }
}
