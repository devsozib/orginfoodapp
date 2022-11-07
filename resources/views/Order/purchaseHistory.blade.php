@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Stock History</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header d-print-none">
                        <h2 class="mb-3">All Stocks</h2><br>
                        <div class="row mt-3 d-print-none">
                            <div class="col-12 col-md-2">

                            </div>
                            <div class="col-12 col-md-2">

                            </div>
                            <div class="col-12 col-md-2">
                                @if(auth()->user()->role == 'super_admin')
                                <label for="">Branch</label>
                                <select onchange="getHistoryTable()" class="form-select form-control" aria-label="Default select example" id="branch">
                                    <option value="" selected>All</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="">Product</label>
                                <select onchange="getHistoryTable()" class="form-select form-control" aria-label="Default select example" id="product">
                                    <option value="" selected>All</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->products_name.'-'.$product->grade_name}}</option>
                                    @endforeach
                                  </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="">From Date</label>
                                <input onchange="getHistoryTable()" type="date" class="form-select form-control" id="from_date">
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="">To Date</label>
                                <input onchange="getHistoryTable()" type="date" class="form-select form-control" id="to_date">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body" >
                        <div class="table-responsive" id="purchase_history_table">

                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- #END# Basic Table -->

    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" ></script>
<script type="text/javascript">


getHistoryTable("");


    function getHistoryTable(){
        // alert('');
        let branch = "";
        if(document.getElementById("branch"))
            branch = document.getElementById('branch').value;

        product = document.getElementById('product').value;
        from = document.getElementById('from_date').value;
        to = document.getElementById('to_date').value;
        // alert(from);
        $.get('{{route('purchase_history_table')}}', {branch:branch, product:product, from:from, to:to}, function(data){
            document.getElementById('purchase_history_table').innerHTML = data;
        });
    }


</script>
@endsection
