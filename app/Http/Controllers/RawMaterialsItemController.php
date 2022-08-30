<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MaterialsItem;

class RawMaterialsItemController extends Controller
{
    public function index(){
        $raw_materials_items = MaterialsItem::get();
        return view('raw_materials_item.index',compact('raw_materials_items'));
    }
}
