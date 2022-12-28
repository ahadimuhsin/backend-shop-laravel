<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $guarded = [];

    //getImageAttribute
    public function getGambarAttribute()
    {
        return asset('storage/orders/'.$this->image);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
