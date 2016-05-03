<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'baby_id', 'email', 'password', 'address', 'birth_date', 'phone','picture_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token'
    ];

    public function role(){
        return $this->belongsToMany('App\Role', 'user_roles');
    }

    public function isMommy(){
        return $this->role()->id == 1;
    }
    public function isKader(){
        return $this->role()->id == 2;
    }
    public function isDoctor(){
        return $this->role()->id == 3;
    }

    public function question(){
        return $this->hasMany('App\Question');
    }

    public function baby(){
        return $this->hasOne('App\Baby');
    }
}
