<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discussion extends Model
{
    protected $fillable = ['chat_id','user_id','message','is_read','is_doc','is_image'];

    public  function chats()
    {
        return $this->hasMany('App\Chat');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
