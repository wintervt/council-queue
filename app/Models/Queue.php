<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = ['service_id', 'customer_type_id', 'customer_name'];

    public function customer_type()
    {
        return $this->hasOne(CustomerType::class);
    }

    public function service()
    {
        return $this->hasOne(Service::class);
    }
}
