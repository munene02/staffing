<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Glove extends Model
{
    protected $fillable = ['glove', 'quantity', 'reoder_level'];
}
