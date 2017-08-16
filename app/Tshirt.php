<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tshirt extends Model
{
    protected $fillable = ['size', 'quantity', 'reoder_level'];
}
