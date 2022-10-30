@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> Your Notification </h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                        Your Notification

                        </h2>

                        @if (auth()->user()->role =='sr' )
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('request_product') }}">Request for product</a>
                        </ul>
                        @endif
                    </div>

                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    @if (auth()->user()->role != 'admin')
                                    <th>Branch</th>
                                    @endif
                                    @if (auth()->user()->role != 'sr')
                                    <th>Sr</th>
                                    @endauth
                                    <th>Request Quantity</th>
                                    <th>In Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                            @foreach ($notifications as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $item->product_name }}</td>
                                    @if (auth()->user()->role != 'admin')
                                    <td>{{ $item->branch_name }}</td>
                                    @endif
                                    @if (auth()->user()->role != 'sr')
                                    <td>{{ $item->sr_name }}</td>
                                    @endauth
                                    <td>{{ $item->request_quantity }}</td>
                                    <td>{{ $item->in_need_date }}</td>
                                    <td>{{ $item->status?"Stock not added":"" }}</td>
                                    @if (auth()->user()->role != 'sr')
                                    <td><a class="btn btn-primary" href="{{ route('add_stock_for_request',$item->product_id) }}">Add Stcok</a></td>
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
@endsection
