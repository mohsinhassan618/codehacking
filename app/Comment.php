<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\CommentReply;

class Comment extends Model
{
    //

    protected $fillable = [
        'post_id',
        'is_active',
        'author',
        'email',
        'body',
        'user_id'
    ];

    public function replies(){
        return $this->hasMany('App\CommentReply');
    }

    public function replies_active(){
        return $this->hasMany('App\CommentReply')->where('is_active',1);
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
