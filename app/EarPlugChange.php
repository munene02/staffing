<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EarPlugChange extends Model
{
    public function earPlug()
    {
    	return $this->belongsTo(EarPlug::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
