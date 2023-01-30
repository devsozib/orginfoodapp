@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Place your order
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Place order</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('whole_seller_orders') }}">Order Status</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_whole_seller_orders')}}">
                            @csrf
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="">Products</label>
                                            <select id="unit" class="form-control" name="product_id" value="">
                                                <option value="" selected hidden disabled>-- Please select --</option>
                                                @foreach ($product_information as $product)
                                                <option value="{{ $product->product_id }}">{{ $product->product_name.'-'.$product->grade_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="col-sm-4">
                                    <label class="">Request Quantity</label>
                                    <input type="number" class="form-control" placeholder="Quantity" name="request_qty" required>
                                    @error('request_qty')
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                </div>

                                <div class="col-sm-4">
                                    <div class="form-line">
                                        <label class="">In Date</label>
                                        <input type="date" class="form-control" placeholder="" name="in_date" required>
                                        @error('date')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                            </div>

                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


@endsection
