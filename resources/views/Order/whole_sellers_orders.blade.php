@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>All Whole Seller Order Status</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All  Whole Seller Order Status
                        </h2>
                        @if (auth()->user()->role == "whole_seller")
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('whole_seller_order_place') }}">Place Order</a>
                        </ul>
                        @endif

                    </div>
                    <div class="body table-responsive" id="order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>BRANCH</th>
                                    <th>PRODUCT</th>
                                    <th>Quantity</th>
                                    <th>date</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($orders as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $item->whole_seller_name }}</td>
                                    <td>{{ $item->branch_name }}</td>
                                    <td>{{ $item->product_name }}-{{ $item->grade_name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty * $item->price }}</td>
                                    <td>
                                        <select id="select_status{{ $loop->index+1 }}" onChange="orderStatusChange({{ $item->id }}, 'select_status{{ $loop->index+1 }}')"  class="form-select custom-select" name="status">

                                      @if ($item->status == "pending")
                                       <option {{  $item->status == 'pending'? 'selected disabled hidden': "" }}>Pending</option>
                                      @endif

                                        @if ((auth()->user()->role == "admin" && $item->status == "pending") or $item->status == 'cancel')
                                        <option {{  $item->status == 'cancel'? 'selected disabled hidden': "" }} value="cancel">Cancel</option>
                                        @endif

                                        @if ((auth()->user()->role == "admin" && $item->status == "pending") or $item->status == 'delivered')
                                        <option  {{  $item->status == 'delivered'? 'selected disabled hidden':""}}  value="delivered">Delivered</option>
                                        @endif

                                        @if ((auth()->user()->role == "sr" && $item->status == 'delivered') or $item->status == 'due' )

                                        <option {{  $item->status == 'due'? 'selected disabled hidden':""}} value="due">Due</option>

                                        @endif

                                        @if ((auth()->user()->role == "sr" && ($item->status == 'delivered' || $item->status == 'due')) or $item->status == 'collected')
                                        <option {{  $item->status == 'collected'? 'selected disabled hidden':""}}  value="collected">Collected</option>
                                        @endif

                                        @if ((auth()->user()->role == "account" && ($item->status == 'due' || $item->status == 'collected'||  $item->status == 'delivered')) or $item->status == 'paid')
                                        <option {{  $item->status == 'paid'? 'selected disabled hidden':""}}  value="paid">Paid</option>
                                        @endif
                                      </select>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>

<script type="text/javascript">
function orderStatusChange(id, item_id){

    // alert(status);
    var data = document.getElementById(item_id).value;
    var url= "{{ url()->current()}}"
    $.get('{{ route('change-order-whole-seller-status') }}', {data:data,id:id},function(data){
        // console.log(data);
        // if(data == "Error"){
        //    document.getElementById('error_message').classList.remove('d-none');
        //    document.getElementById('error_text').innerText = "e";
        // }
         $('body').load(url);
    });



}
</script>
@endsection
