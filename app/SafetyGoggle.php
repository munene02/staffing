<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SafetyGoggle extends Model
{
    protected $fillable = ['safety_goggle', 'quantity', 'reoder_level'];
}
