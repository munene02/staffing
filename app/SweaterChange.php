<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SweaterChange extends Model
{
    public function sweater()
    {
    	return $this->belongsTo(Sweater::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
