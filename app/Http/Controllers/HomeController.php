<?php

namespace App\Http\Controllers;

use App\Models\Sr;
use App\Models\Order;
use App\Models\Branch;
use App\Models\Distributor;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $branch = Branch::count();
        $sr = Sr::count();
        $distributor = Distributor::count();
        $order = Order::where('status','delivered')->count();
        return view('home',compact('branch','sr','distributor','order'));
    }
}
