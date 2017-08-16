<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boot extends Model
{
	protected $fillable = ['quantity', 'reoder_level'];

    public function brand()
    {
    	return $this->belongsTo(Brand::class); 
    }

    public function bootHeight()
    {
    	return $this->belongsTo(BootHeight::class);
    }

    public function shoeSize()
    {
    	return $this->belongsTo(ShoeSize::class);
    }

    public function bootChange()
    {
        return $this->hasMany(BootChange::class);
    }
}
