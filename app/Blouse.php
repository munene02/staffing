<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blouse extends Model
{
    protected $table = 'blouses';
    protected $fillable = ['quantity', 'reoder_level'];
}
