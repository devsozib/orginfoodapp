<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Models\MaterialsStock;

class MaterialsStockController extends Controller
{
    public function materialsStock(){
        if(auth()->user()->role == 'admin'){
            $branch = Branch::where('user_id', auth()->user()->id)->first('id');
            $condition = ['branch_id', '=', $branch->id];
        }else{
            $condition = ['branch_id', '!=', 0];
        }

        $materials_Stock = MaterialsStock::join('materials_items','materials_stocks.materials_item_id','=','materials_items.id')
        ->join('branches','branches.id','=','materials_stocks.branch_id')
        ->where([$condition])
        ->select('materials_items.name as materials_name','branches.name as branch_name','materials_stocks.qty', 'materials_items.unit as unit')
        ->get();

        return view('raw_materials_item.stock',compact('materials_Stock'));
    }
}
