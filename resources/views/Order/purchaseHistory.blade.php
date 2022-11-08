@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <div class="logo text-center d-none d-print-block">
                <img width=100px src="{{ asset('assets/images/cropped-Orgin-English-Logo-01-1-270x270.png') }}" alt="">
             </div>
            <h2 class="print-text-center" ><span id="filtering"></span></h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card d-print-none">
                    <div class="header d-print-none">
                        <h2 class="mb-3">All Stocks History</h2><br>
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

            // if(data.product.product_name||data.product.grade_name||data.branch||data.from_date||data.to_date){
            //     document.getElementById('filtering').innerText = (data.product.product_name+'-'+data.product.grade_name)+'-'+data.branch.name;
            // }else{
            //     document.getElementById('filtering').innerText = "All";
            // }
            var filterData = getTitle();
            document.getElementById('filtering').innerHTML = filterData;
            document.getElementById('purchase_history_table').innerHTML = data.purchaseHistoryTable;
        });
    }

    function getTitle(){
        let branch = null;


        if(document.getElementById("branch")){
            branch = document.getElementById("branch");
            branch =  branch.options[ branch.selectedIndex ].innerHTML;
        }

        var product = document.getElementById( "product");
        product =  product.options[ product.selectedIndex ].innerHTML;

        from = document.getElementById('from_date').value;
        to = document.getElementById('to_date').value;


       let title = "All ";

       if(product != 'All'){
            title += product+" ";
       }
       title += "stock history ";


        if(branch != null && branch != "All"){
                title += "of "+branch+" ";
        }

        if(to == ""){
            to =  new Date().toJSON().slice(0, 10);
        }
        if(from != ""){
            title += "<br/>Of date: "+from+" ";
            if(from != to)title += "to "+to;
        }

        return title;
    }
</script>
@endsection
