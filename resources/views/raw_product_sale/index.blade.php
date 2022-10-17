@extends('layouts.app')
@section('content')

<section class="">
   <!--<purchase-materials-table ></purchase-materials-table>-->


    <div class="container-fluid">
        <div class="block-header">
            <h2> All Raw product sales history</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All raw product sales history
                        </h2>

                        @if (auth()->user()->role != 'super_admin')
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('raw_product_sale_create') }}">Sale Raw Products</a>
                        </ul>
                        @endif

                    </div>

                    <!--<all-production></all-production>-->

                     <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Raw Product Name</th>
                                    <th>Consumer Name</th>
                                    @if (auth()->user()->role == 'super_admin')
                                    <th>Branche Name</th>
                                    @endif
                                    <th>Qty</th>
                                    <th>Total Amount</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php

                                @endphp
                            @foreach ($rawProducts as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{$item->proName}}</td>
                                    <td>{{ $item->consumerName }}</td>
                                    @if (auth()->user()->role == 'super_admin')
                                     <td>{{ $item->branch_name}}</td>
                                     @endif
                                     <td>{{$item->qty}}</td>
                                     <td>{{$item->total_amount}}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ _('...') }}</td>
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
