<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function hasRole($role){
        return $this->role === $role;
    }


    public function isTeacher(){
        return $this->role === 'teacher';
    }

    public function isStudent(){
        return $this->role === 'first_class' || $this->role === 'final_class';
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }
    public function scores(){
        return $this->hasMany('App\Score');
    }

    
    

}
