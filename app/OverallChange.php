<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OverallChange extends Model
{
    public function overall()
    {
    	return $this->belongsTo(Overall::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
