<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $fillable = [
        'total',
        'user_id','customer_id',
        'due_date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
