<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Overall extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
