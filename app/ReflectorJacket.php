<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReflectorJacket extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
