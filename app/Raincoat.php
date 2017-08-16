<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raincoat extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
