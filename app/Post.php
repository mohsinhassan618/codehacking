<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Photo;


class Post extends Model
{
    //

    protected $fillable = [
        'title',
        'body',
        'user_id',
        'category_id',
        'photo_id',
    ];



    public function user(){
        return $this->belongsTo('App\User');
    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

}
