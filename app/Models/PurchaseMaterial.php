<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseMaterial extends Model
{
    use HasFactory;

    public function vendor(){
       return $this->hasOne(Vendor::class,'id', 'vendor_id');
    }

    public function materialsItem(){
        return $this->hasOne(MaterialsItem::class,'id', 'materials_item_id');
     }
}
