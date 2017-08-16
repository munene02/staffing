<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trouser extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
