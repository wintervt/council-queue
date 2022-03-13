<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerType extends Model
{
    protected $fillable = ['name'];

    public function queue()
    {
        return $this->belongsTo(Queue::class);
    }
}
