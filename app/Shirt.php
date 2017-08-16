<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shirt extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
