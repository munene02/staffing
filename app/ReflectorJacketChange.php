<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReflectorJacketChange extends Model
{
    public function reflectorJacket()
    {
    	return $this->belongsTo(ReflectorJacket::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
}
