<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function sender(){
        return $this->belongsTo('App\User', 'sender_id');
    }

    public function chat(){
        return $this->belongsTo('App\Chat');
    }

    public function getCreatedAtAttribute($value)
    {
        return date('h:i', strtotime($value));
    }

    public function getUpdatedAtAttribute($value)
    {
        return date('h:i', strtotime($value));
    }
}
