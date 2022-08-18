@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Product</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Stock

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            @if (auth()->user()->role != 'super_admin')
                            <a class="btn-sm btn-primary float-right"href="{{ route('add_stock') }}">Add Stock</a>
                            @endif
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($stocks as $stock)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $stock->branch->name }}</td>
                                    <td>{{ $stock->product->name }}</td>
                                    <td>{{ $stock->qty }}</td>
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
