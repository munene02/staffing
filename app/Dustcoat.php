<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dustcoat extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
