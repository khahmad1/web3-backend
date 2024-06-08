<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\category;
use App\Models\type;
class medicine extends Model
{
    use HasFactory;
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function type(){
        return $this->belongsTo(type::class);
    }
    public function company(){
        return $this->belongsTo(company::class);
    }
}
