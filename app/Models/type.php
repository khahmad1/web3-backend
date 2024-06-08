<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class type extends Model
{
    use HasFactory;
    protected $table = "type";
    protected $fillable = ["type"];
    public function medicine(){
        return $this->hasMany(medicine::class);
    }
}
