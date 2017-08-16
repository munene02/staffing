<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GloveChange extends Model
{
    public function glove()
    {
    	return $this->belongsTo(Glove::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
