@extends('layouts.app')
@section('content')

<section class="">
  {{-- <purchase-materials-table ></purchase-materials-table> --}}


  <div class="container-fluid">
    <div class="block-header">
        <h2> All Purchanse Materials </h2>
    </div>
    <!-- Basic Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                    All Purchanse Materials

                    </h2>

                    @if (auth()->user()->role != 'super_admin')
                    <ul class="header-dropdown m-r--5">
                        <a class="btn-sm btn-primary float-right"href="{{ route('purchase_materials') }}">Purchase Materials</a>
                    </ul>
                    @endif

                </div>

                <!--<all-production></all-production>-->

                <div class="body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Item Name</th>
                                <th>Vendor Name</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @php

                            @endphp
                        @foreach ($materials_list as $item)
                            <tr>
                                <th scope="row">{{ $loop->index+1 }}</th>
                                <td>{{$item->item_name}}</td>
                                <td>{{ $item->vendor_name }}</td>
                                 <td>{{ $item->price}}</td>
                                <td>{{ $item->qty }}</td>
                                <td>{{$item->date}}</td>
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
