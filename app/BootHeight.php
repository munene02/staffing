<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BootHeight extends Model
{
    protected $fillable = ['height'];
    public function boots()
    {
    	
    	return $this->hasMany(Boot::class);
    }
}
