@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid printable">
        <div class="block-header">
            <h2>Sales History</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header  d-print-none">
                        <h2 class="mb-3">All Sales History</h2><br>
                        <div class="row mt-3 d-print-none">
                            <div class="col-12 col-md-2">
                                @if(auth()->user()->role == 'super_admin')
                                <label for="">Branch</label>
                                <select onchange="getSRs(this.value)" class="form-select form-control" aria-label="Default select example" id="branch">
                                    <option value="" selected>All</option>
                                    @foreach ($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->name}}</option>
                                    @endforeach
                                  </select>
                                  @endif
                            </div>
                            <div class="col-12 col-md-2">
                                @if(auth()->user()->role == 'super_admin' or auth()->user()->role == 'admin')
                                    <label for="">SR</label>
                                    <select onchange="getDistributors()" class="form-select form-control" aria-label="Default select example" id="sr">

                                    </select>
                                @endif
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="">Distributor</label>
                                <select onchange="getHistoryTable()" class="form-select form-control" aria-label="Default select example" id="distributor">


                                </select>
                            </div>
                            <div class="col-12 col-md-2">
                                <label for="">Product</label>
                                <select onchange="getHistoryTable()" class="form-select form-control" aria-label="Default select example" id="product">
                                    <option value="" selected>All</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->product_id}}">{{$product->product_name.'-'.$product->grade_name}}</option>
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
                    <div class="body printable" >
                        <div class="table-responsive printable" id="sales_history_table">
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

    getDistributors();
    getSRs('');

    function getSRs(id){

        $.get('{{route('get_srs')}}', {branch_id:id}, function(data){
            document.getElementById('sr').innerHTML = data;
            getDistributors();
        });
    }
    function getDistributors(){
        let branch = "";
        let sr = "";

        if(document.getElementById("branch"))
            branch = document.getElementById('branch').value;
        if(document.getElementById("sr"))
            sr = document.getElementById('sr').value;

        // alert(branch+" -- "+sr);
        $.get('{{route('get_distributors')}}', {branch_id:branch, sr_id:sr}, function(data){
            // alert(data);
            document.getElementById('distributor').innerHTML = data;
            getHistoryTable();
        });
    }

    function getHistoryTable(){
        let branch = "";
        let sr = "";

        if(document.getElementById("branch"))
            branch = document.getElementById('branch').value;
        if(document.getElementById("sr"))
            sr = document.getElementById('sr').value;

        distributor = document.getElementById('distributor').value;
        product = document.getElementById('product').value;
        from = document.getElementById('from_date').value;
        to = document.getElementById('to_date').value;
        // alert(from);
        $.get('{{route('sales_history_table')}}', {branch:branch, sr:sr, distributor:distributor, product:product, from:from, to:to}, function(data){
            document.getElementById('sales_history_table').innerHTML = data;
        });
    }


</script>
@endsection
