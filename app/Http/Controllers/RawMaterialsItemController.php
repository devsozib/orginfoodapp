<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\MaterialsItem;
use App\Models\MaterialsStock;

class RawMaterialsItemController extends Controller
{
    public function index(){
        $raw_materials_items = MaterialsItem::get();
        return view('raw_materials_item.index',compact('raw_materials_items'));
    }

    protected function create(){
        return view('raw_materials_item.create');
    }

    protected function store(Request $request){

           $request->validate([
            "name" => "required",
           ]);

           $raw_materials_items = new MaterialsItem;

           $raw_materials_items->name = $request->name;
           $raw_materials_items->unit = "liter";

           $raw_materials_items->save();
           return back()->with('success', "Insert Successful");
    }


}
