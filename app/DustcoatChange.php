<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DustcoatChange extends Model
{
    public function dustcoat()
    {
    	return $this->belongsTo(Dustcoat::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
