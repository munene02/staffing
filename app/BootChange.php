<?php

namespace App;
use App\Boot;
use Illuminate\Database\Eloquent\Model;

class BootChange extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function boots()
    {
    	return $this->belongsTo('App\Boot', 'boot_id');
    }
}
