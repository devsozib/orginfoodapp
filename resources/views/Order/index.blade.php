@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>All Order Status</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Order Status
                        </h2>
                        @if (auth()->user()->role == "sr")
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('order_place') }}">Place Order</a>
                        </ul>
                        @endif

                    </div>
                    <div class="body table-responsive" id="order_table">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>SR</th>
                                    <th>BRANCH</th>
                                    <th>PRODUCT</th>
                                    <th>DISTRIBUTOR</th>
                                    <th>Quantity</th>
                                    <th>Price <span style="font-size: 10px; text-style: none;">(Per Unit)</span> </th>
                                    <th>Total</th>
                                    <th>Collected</th>
                                    <th>Paied</th>
                                    <th>date</th>
                                    <th>Status</th>
                                    {{-- @if ($item->status == 'delivered')
                                    <th>Payment Status</th>
                                    @endif --}}
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($orders as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $item->sr_name }}</td>
                                    <td>{{ $item->branch_name }}</td>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->distributor_name }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty *  $item->price}}</td>
                                    <td>{{$item->collected_amount}}</td>
                                    <td>{{$item->paid_amount}}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>
                                        <select id="select_status{{ $loop->index+1 }}" onChange="orderStatusChange({{ $item->id }}, 'select_status{{ $loop->index+1 }}')" class="form-select form-control" name="status">

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

                                      {{-- @if(session()->get('qty'))
                                      <span  class="text-danger ">
                                          <strong >{{ session()->get('qty') }}</strong>
                                      </span>
                                      @endif --}}
                                      {{-- @php
                                          session()->forget(['qty']);
                                      @endphp --}}

                                    </td>
                                    @if ($item->status == 'delivered')
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                   Action
                                                  <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                  <li><a href="">Payment History</a></li>
                                                  {{-- <li><a href="">Sales History</a></li> --}}
                                                  @if (auth()->user()->role == "sr")
                                                    <li><a href="{{route('collect_payment', $item->id)}}">Collect Payment</a></li>
                                                  @endif
                                                  @if (auth()->user()->role == "account")
                                                    <li><a href="{{route('collect_payment', $item->id)}}">Get Payment</a></li>
                                                  @endif
                                                </ul>
                                              </div>
                                        </td>
                                    @endif

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
    $.get('{{ route('change-order-status') }}', {data:data,id:id},function(data){
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
