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
                                    <th>date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
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
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->status }}</td>

                                    <td><select id="select_status{{ $loop->index+1 }}" onChange="orderStatusChange({{ $item->id }}, 'select_status{{ $loop->index+1 }}')" class="form-select" name="status">
                                        <option value="" selected hidden disabled>Change Status</option>
                                        @if (auth()->user()->role == "admin")
                                        <option value="cancel">Cancel</option>
                                        <option value="delevered">Delevered</option>
                                        @endif
                                        @if (auth()->user()->role == "sr")
                                        <option value="due">Due</option>
                                        <option value="collected">Collected</option>
                                        @endif
                                        @if (auth()->user()->role == "account")
                                        <option value="paid">Paid</option>
                                        @endif
                                      </select></td>

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
        //console.log(data);
         $('body').load(url);
    });



}
</script>
@endsection
