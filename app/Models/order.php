<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        "totalPrice",
        "date",
        "facility_id",
        "message",
        "status"
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function orderLine(){
        return $this->hasMany(orderLine::class);
    }
}
