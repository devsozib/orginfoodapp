@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Sales History</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Sales Historis of <a href="">{{ $consumerName->name }}</a>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('raw_product_sale_create') }}">Sale Product</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    @if (auth()->user()->role == 'super_admin')
                                    <th>Branch Name</th>
                                    @endif
                                    <th>Raw Product Name</th>
                                    <th>Product Price</th>
                                    <th>Sale Qty</th>
                                    <th>Total Price</th>
                                    <th>Sale Date</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($salesHistory as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    @if (auth()->user()->role == 'super_admin')
                                    <td>{{ $item->branch_name }}</td>
                                    @endif
                                    <td>{{ $item->proName }}</td>
                                    <td>{{ $item->price }}</td>
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->qty*$item->price }}</td>
                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    {{-- <td>{{$item->qty * $item->price }}</td> --}}
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
