<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected function branch(){
        return $this->hasOne(Branch::class,'id', 'branch_id');
    }

    protected function product(){
        return $this->hasOne(Product::class,'id', 'product_id');
    }

    protected function grade(){
        return $this->hasOne(Grade::class,'id','grade_id');
    }
}
