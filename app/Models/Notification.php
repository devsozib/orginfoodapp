<?php

namespace App\Models;

use App\Models\Sr;
use App\Models\Branch;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notification extends Model
{
    use HasFactory;

    public function product(){
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function branch(){
        return $this->hasOne(Branch::class,'id','branch_id');
    }

    public function sr(){
        return $this->hasOne(Sr::class,'id','sr_id');
    }
}
