<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShiftProduct extends Model
{
    use HasFactory;

    public function branch(){
        return $this->hasOne(Branch::class,'id', 'branch_id');
    }


    public function product(){
        return $this->hasOne(Product::class,'id', 'product_id');
    }
}
