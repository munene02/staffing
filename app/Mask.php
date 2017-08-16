<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mask extends Model
{
    protected $fillable = ['mask', 'quantity', 'reoder_level'];
}
