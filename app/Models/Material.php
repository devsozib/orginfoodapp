<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    public function vendor(){
       return $this->hasOne(Vendor::class,'id', 'vendor_id');
    }
}
