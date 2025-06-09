<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction_detail extends Model
{
    
    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

}
