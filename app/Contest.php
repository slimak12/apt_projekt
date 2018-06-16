<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contest extends Model
{
    //

    public function photo(){
        return $this->belongsTo(Photo::class);
    }

    public function owner(){
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users(){
        return $this->hasMany(ContestUser::class);
    }

}
