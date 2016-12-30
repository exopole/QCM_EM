<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function comments(){
   		return $this->belongsToMany('App\Comment');
   }

}
