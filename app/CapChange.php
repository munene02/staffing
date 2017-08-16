<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CapChange extends Model
{
    public function cap()
    {
    	return $this->belongsTo(Cap::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
