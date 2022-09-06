@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Production</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Production

                        </h2>

                        @if (auth()->user()->role != 'super_admin')
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('add_production') }}">Add Production</a>
                        </ul>
                        @endif

                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product</th>
                                    @if (auth()->user()->role == "super_admin")
                                    <th>Branch</th>
                                    @endif
                                    <th>Production Qty</th>
                                    <th>Raw Materials Qty</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>


                            @foreach ($productions as $production)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $production->product_name }}</td>
                                    @if (auth()->user()->role == "super_admin")
                                    <td>{{ $production->branch_name }}</td>
                                    @endif

                                    <td>{{ $production->production_qty }}</td>
                                    <td>{{ $production->raw_materials_qty }}</td>
                                    <td>{{ $production->unit }}</td>
                                    <td>{{ $production->date }}</td>
                                    <td>...</td>

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
