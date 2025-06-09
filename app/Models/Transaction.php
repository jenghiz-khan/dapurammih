<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function transaction_detail()
    {
        return $this->hasMany(Transaction_detail::class);
    }

}
