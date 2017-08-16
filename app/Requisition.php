<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public function requisitionDetail()
    {
    	return $this->belongsTo(RequisitionDetail::class);
    }
    
     public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
