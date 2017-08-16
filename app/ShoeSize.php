<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoeSize extends Model
{
    protected $fillable = ['size'];

    public function boots()
    {
    	return $this->hasMany(Boot::class);
    }
}
