<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['service_id', 'customer_type_id', 'customer_name'];

    protected $casts = [
        'created_at' => 'datetime:g:i A'
    ];

    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class);
    }


    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
