<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MaskChange extends Model
{
    public function mask()
    {
    	return $this->belongsTo(Mask::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
