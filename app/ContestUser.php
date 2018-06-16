<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestUser extends Model
{
    public function contest(){
        return $this->hasOne(Contest::class, 'id', 'contest_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }


    public function result()
    {
        return $this->belongsTo(ContestResult::class, 'id', 'contest_user_id');
    }

}
