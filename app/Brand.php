<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = ['brand'];
    
    public function boots()
    {
    	return $this->hasMany(Boot::class);
    }
}
