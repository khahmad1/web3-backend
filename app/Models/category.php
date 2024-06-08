<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\medicine;
class category extends Model
{
    use HasFactory;
    protected $fillable = ["name"];
    public function medicine(){
        return $this->hasMany(medicine::class);
    }
}
