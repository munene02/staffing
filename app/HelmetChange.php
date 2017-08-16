<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HelmetChange extends Model
{
    public function helmet()
    {
    	return $this->belongsTo(Helmet::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
