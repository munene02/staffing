<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChinstrapChange extends Model
{
    public function chinstrap()
    {
    	return $this->belongsTo(Chinstrap::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
