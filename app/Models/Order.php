<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
    
    public function order_detail()
    {
        return $this->hasMany(Order_detail::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }
}
