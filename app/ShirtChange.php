<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShirtChange extends Model
{
    public function shirt()
    {
    	return $this->belongsTo(Shirt::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
