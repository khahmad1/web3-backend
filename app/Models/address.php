<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class address extends Model
{
    use HasFactory;
    protected $table = "address";
    protected $fillable = ["street","country","city"];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
