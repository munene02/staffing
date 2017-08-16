<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyGoggleChange extends Model
{
    public function safetyGoggle()
    {
    	return $this->belongsTo(SafetyGoggle::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
