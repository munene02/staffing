<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlouseChange extends Model
{
    public function blouse()
    {
    	return $this->belongsTo(Blouse::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
