<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function question(){
        return $this->belongsTo('App\Question');
    }

}
