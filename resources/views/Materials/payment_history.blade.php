@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>Payment History</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Payment Historis of <a href="">{{ $vendor_name->vendor_name }}</a>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('purchase_materials') }}">Purchase Materials</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Purchase Date</th>
                                    <th>Paid Amaount</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($paymentHistory as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>

                                    <td>{{ \Carbon\Carbon::parse($item->date)->format('d M Y') }}</td>
                                    <td>৳{{ $item->amount }}</td>
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
