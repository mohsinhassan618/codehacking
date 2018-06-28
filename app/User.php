<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Post;
use function md5;
use function strtolower;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role_id','is_active','photo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if($this->role->name == 'Administrator' && $this->is_active == 1 ){
            return true;
        }
        return false;
    }
    public function role() {
        return $this->belongsTo('App\Role');

    }

    public function photo(){
        return $this->belongsTo('App\Photo');
    }


    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function getGravatarAttribute(){

        $hash = md5(strtolower($this->attributes['email'] ));

        return "https://www.gravatar.com/avatar/$hash?d=mp";

    }
}
