<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TshirtChange extends Model
{
    public function tshirt()
    {
    	return $this->belongsTo(Tshirt::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
