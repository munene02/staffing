<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RaincoatChange extends Model
{
    public function raincoat()
    {
    	return $this->belongsTo(Raincoat::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
