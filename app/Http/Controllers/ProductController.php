<?php

namespace App\Http\Controllers;

use App\Models\Grade;

use App\Models\Stock;

use App\Models\Branch;
use App\Models\Product;
use App\Models\Production;
use App\Models\RawProduct;
use App\Models\StockinHistory;
use App\Models\FactoryStock;
use Illuminate\Http\Request;
use App\Models\MaterialsStock;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected function index(){
        $products = Product::where('is_deleted', 0)->get();
        return view('product.index')->with(compact('products'));
    }

    protected function addProductView(){
        $grade = Grade::get();
        return view('product.addProductVidew',compact('grade'));
    }

    protected function store(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'unit' => ['required', 'string', 'in:kg,gm,Ltr,ml,piece'],
            'grade' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ];
        //dd($request->all());
        $grade_id = $request->grade;
        $gradeName = Grade::where('id',$grade_id)->first('name');

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('add_product')->withInput()->withErrors($validator);
		}
        else{
            try{
                $data = $request->all();
                $product = new Product;
                $product->name = $data['name'];
                $product->unit = $data['unit'];
                $product->grade_id = $grade_id;
                $product->price = $data['price'];
                $product->save();
                return redirect()->route('add_product')->with('success',"Insert successfully");
            }catch(Exception $e){
                return redirect()->route('add_product')->with('error',"operation failed");
            }
        }
    }

    protected function addProductionView(){
        $raw_products = RawProduct::get();

        $raw_materials = MaterialsStock::join('materials_items','materials_stocks.materials_item_id','=','materials_items.id')
        ->select('materials_items.name as item_name','materials_stocks.materials_item_id')
        ->get();

        return view('product.addProductionView')->with(compact('raw_products','raw_materials'));
    }

    protected function storeProduction(Request $request){

        // return $request->all();

        $rules= [
            'raw_product_id' => ['required', 'numeric'],
            'raw_materials_id' => ['required', 'numeric'],
            'production_qty' => ['required', 'numeric'],
            'raw_materials_qty' => ['required', 'numeric'],
            'date' => ['required', 'date'],
        ];
        //dd($request->all());

        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails()) {
			return redirect()->route('add_production')->withInput()->withErrors($validator);
		}
        else{
            try{
                $branch = Branch::where('user_id', auth()->user()->id)->first();

                $factory_stock_check = FactoryStock::where('branch_id',$branch->id)->where('raw_product_id', $request->raw_product_id)->first();

                $material_stock = MaterialsStock::where('materials_item_id',$request->raw_materials_id)->where('branch_id',$branch->id)->first();

                // return $material_stock->qty;
             //For Production Table
             if($material_stock->qty >= $request->raw_materials_qty){
                $data = $request->all();
                $production = new Production;
                $production->raw_product_id =  $data['raw_product_id'];
                $production->raw_materials_id =  $data['raw_materials_id'];
                $production->branch_id =  $branch->id;
                $production->production_qty =  $data['production_qty'];
                $production->raw_materials_qty =  $data['raw_materials_qty'];
                $production->date =  $data['date'];
                $production->save();



                $material_stock->qty -= $request->raw_materials_qty;
                $material_stock->update();



              //For Stock Table
                if($factory_stock_check){
                    $factory_stock_check->qty += $request->production_qty;
                    $factory_stock_check->update();
                  }else{
                    $stockData = new FactoryStock;
                    $stockData->branch_id = $branch->id;
                    $stockData->raw_product_id = $request->raw_product_id;
                    $stockData->qty = $request->production_qty;
                    $stockData->save();
                  }

                }else{
                    return "You have available materials stock";
                }

                return redirect()->route('add_production')->with('success',"Insert successfully");



            }catch(Exception $e){
                return redirect()->route('add_production')->with('error',"operation failed");
            }
        }
    }

    protected function productionList(){

        if(auth()->user()->role == 'admin'){
            $branch_id = Branch::where('user_id', auth()->user()->id)->first('id');
            $condition = ['branch_id', '=', $branch_id->id];
        }else{
            $condition = ['branch_id', '!=', 0];
        }
        $productions = Production::join('raw_products','raw_products.id', '=', 'productions.raw_product_id')
        ->join('branches','branches.id','=','productions.branch_id')
        ->where([$condition])
        ->where('productions.is_deleted', 0)
        ->select('productions.id','raw_products.name as product_name','productions.production_qty', 'productions.date', 'raw_products.unit as unit', 'productions.raw_materials_qty','branches.name as branch_name')
        ->get();
        return view('product.production')->with(compact('productions'));

    }

    public function searchItem(Request $request){


        if(auth()->user()->role == 'admin'){
            $branch_id = Branch::where('user_id', auth()->user()->id)->first('id');
            $condition = ['branch_id', '=', $branch_id->id];
        }else{
            $condition = ['branch_id', '!=', 0];
        }

        if(auth()->user()->role == "super_admin"){
             $superAdmin = true;
        }else{
            $superAdmin = false;
        }


        //Searching start here
        $searchValue = $request->searchValue;

        $filterBy = $request->filterBy;

      if( $searchValue =='date'){
        $fromDate = $request->fromDate;
        $toDate = $request->toDate;
        if($fromDate==null and $toDate ==null){
            $fromDate = '0000-01-01';
            $toDate   =  Date('Y-m-d');
        }
        else if($fromDate == null){
               $fromDate = $toDate;
        }
        else if($toDate == null){
               $toDate = Date('Y-m-d');
        }
      }else if( $searchValue = 'dropdown'){
        if($filterBy == 'today'){
            $fromDate =  Date('Y-m-d');
            $toDate   =  Date('Y-m-d');
        }
        else if($filterBy == 'this_week'){
            $fromDate = Carbon::now()->startOfWeek();
            $toDate = Carbon::now()->endOfWeek();
        }
        else if($filterBy == 'this_month'){
            $fromDate =Date('Y-m-').'01';
            $toDate = date("Y-m-t", strtotime(Date('Y-m-d')));
        }else if($filterBy == 'this_year'){
            $fromDate =Date('Y-').'01-01';
            $toDate = Date('Y-').'12-31';
        }
        else if($filterBy == 'all'){
            $fromDate = '0000-01-01';
            $toDate   =  Date('Y-m-d');
        }
      }

        $productions = Production::join('raw_products','raw_products.id', '=', 'productions.raw_product_id')
        ->join('branches','branches.id','=','productions.branch_id')
        ->where([$condition])
        ->whereBetween('date',[$fromDate, $toDate])
        ->where('productions.is_deleted', 0)
        ->select('productions.id','raw_products.name as product_name','productions.production_qty', 'productions.date', 'raw_products.unit as unit', 'productions.raw_materials_qty','branches.name as branch_name')
        ->get();

        return response()->json(
            [
            'productions'=>$productions,
            'superAdmin'=>$superAdmin
            ]);

            // return $productions;

    }


    protected function purchaseHistory(){
        if(auth()->user()->role  == 'super_admin'){
            $branches = Branch::where('type', 'wirehouse')->get();
            $products = Product::join('grades','grades.id','=','products.grade_id')->select('products.id','products.name as products_name','grades.name as grade_name')->get();
            return view('order.purchaseHistory', compact('branches', 'products'));
        }

        if(auth()->user()->role  == 'admin' || auth()->user()->role  == 'sr'){
            $products = Product::get();
            return view('order.purchaseHistory', compact('products'));
        }
    }

    function purchaseHistoryTable(Request $request){
        $branchId = $request->branch;
        $productId = $request->product;
        $from = $request->from;
        $to = $request->to;

        if(auth()->user()->role == 'admin'){
            $brance = Branch::where('user_id', auth()->user()->id)->first();
            if( !($brance && $brance->type == "wirehouse") ){
                return abort(404);
            }
            $branchId =  $brance->id;
        }

        if($branchId == ''){
            $condition = ['branches.id', '!=', 0];
        }else{
            $condition = ['branches.id', '=', $branchId];
        }

        if($productId == ''){
            $condition2 = ['products.id', '!=', 0];
        }else{
            $condition2 = ['products.id', '=', $productId];
        }

        if($from == ''){
            $from = "0000-00-00";
        }
        if($to == ''){
            $to = date('Y-m-d');
        }

       $stockinHistories = StockinHistory::join('branches', 'branches.id', '=', 'stockin_histories.branch_id')
                            ->join('products', 'products.id', '=', 'stockin_histories.product_id')
                            ->join('grades','products.grade_id','=','grades.id')
                            ->where([$condition])
                            ->where([$condition2])
                            ->whereBetween('stockin_histories.created_at',array($from,$to))
                            ->select('branches.name as branch_name','products.id', 'products.name', 'stockin_histories.qty', 'stockin_histories.created_at','grades.name as grade_name')
                            ->get();
        return view('product.purchaseHistoryTable')->with(compact('stockinHistories'));

    }

}
