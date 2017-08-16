<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReflectorRollChange extends Model
{
    public function reflectorRoll()
    {
    	return $this->belongsTo(ReflectorRoll::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
