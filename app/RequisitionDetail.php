<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionDetail extends Model
{
    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function requisition()
    {
    	return $this->hasOne(Requisition::class);
    }
}
