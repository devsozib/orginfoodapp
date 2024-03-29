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

                    <all-production></all-production>

                     {{-- <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Product Name</th>
                                    <th>Production Quantity</th>
                                    <th>Unit</th>
                                    <th>Raw Materials Qty</th>
                                    <th>Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                                @php

                                @endphp
                            @foreach ($productions as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{$item->branch_name}}</td>
                                    <td>{{ $item->product_name }}</td>
                                     <td>{{ $item->production_qty}}</td>
                                    <td>{{ $item->unit }}</td>
                                    <td>{{ $item->raw_materials_qty }}</td>
                                    <td>{{$item->date}}</td>
                                    <td>{{ _('...') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div> --}}


                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>




@endsection
