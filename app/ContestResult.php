<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContestResult extends Model
{
    //

    public function contest_user()
    {
        return $this->belongsTo(ContestUser::class, 'id' , 'contest_user_id');
    }
}
