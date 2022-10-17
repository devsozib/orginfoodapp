@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Consumer</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Consumers

                        </h2>
                        @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                            <ul class="header-dropdown m-r--5">
                                <a class="btn-sm btn-primary float-right"href="{{ route('create_consumer') }}">Add Consumer</a>
                            </ul>
                        @endif
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    @if (auth()->user()->role == 'super_admin')
                                    <th>Branch Name</th>
                                    @endif
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th>Due</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>


                            @foreach ($consumers as $consumer)
                            @php
                                $due_amount = App\Models\ConsumerAccount::where('consumer_id',$consumer->id)->where('status',0)->sum('amount');

                                $paymentAmont = App\Models\ConsumerAccount::where('consumer_id',$consumer->id)->where('status',1)->sum('amount');
                                $dueIs = $due_amount - $paymentAmont;
                            @endphp
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $consumer->name }}</td>
                                    @if (auth()->user()->role == "super_admin")
                                    <td>{{ $consumer->branch_id }}</td>
                                    @endif
                                    <td>{{ $consumer->address }}</td>
                                    <td>{{ $consumer->phone }}</td>
                                    <td>{{ $dueIs }}</td>
                                     <td>
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                               Action
                                              <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                              <li><a href="{{ route('consumer_payment_history',$consumer->id) }}">Payment History</a></li>
                                              <li><a href="{{ route('consumer_sales_history',$consumer->id) }}">Sales History</a></li>
                                              @if (auth()->user()->role == "admin")
                                              <li><a href="{{ route('collect_due_payment',$consumer->id) }}">Pay</a></li>
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
