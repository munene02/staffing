<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TrouserChange extends Model
{
    public function trouser()
    {
    	return $this->belongsTo(Trouser::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
