<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orderLine extends Model
{
    use HasFactory;
    protected $table = "order_lines";
    protected $fillable = [
        "medicine_id",
        "order_id",
        "price",
        "quantity"
    ];
    function order(){
        return $this->belongsTo(Order::class);
    }
    function medicine(){
        return $this->belongsTo(Medicine::class);
    }
}
