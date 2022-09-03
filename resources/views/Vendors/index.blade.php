@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Vendors</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Vendors

                        </h2>
                        <ul class="header-dropdown m-r--5">
                           @if (auth()->user()->role == "super_admin")
                                <a class="btn-sm btn-primary float-right"href="{{ route('create_vendors') }}">Add Vendor</a>
                           @endif
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Branch</th>
                                    <th>Address</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($own_vendors as $vendor)
                              @php
                                   $total_due_Amount = App\Models\VendorAccount::where('vendor_id',$vendor->id)->where('status',0)->sum('amount');

                                   $total_payment_Amount = App\Models\VendorAccount::where('vendor_id',$vendor->id)->where('status',1)->sum('amount');

                                   $nowDueIs = $total_due_Amount  - $total_payment_Amount  ;
                                //    dd( $nowDueIs );

                              @endphp
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $vendor->vendor_name }}</td>
                                    <td>{{ $vendor->branch_name }}</td>
                                    <td>{{ $vendor->address }}</td>
                                    <td>৳{{ $nowDueIs}}</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                               Action
                                              <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                              <li><a href="{{ route('purchase_history',$vendor->id) }}">See History</a></li>
                                              @if (auth()->user()->role == "admin")
                                              <li><a href="{{ route('due_payment',$vendor->id) }}">Pay</a></li>
                                              @endif
                                            </ul>
                                          </div>
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
@endsection
