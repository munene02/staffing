<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApronChange extends Model
{
     public function apron()
    {
    	return $this->belongsTo(Apron::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
