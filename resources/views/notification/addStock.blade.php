@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> Add Stock for SR Request</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add Stock for SR Request</h2>

                        </h2>

                        @if (auth()->user()->role != 'super_admin')
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('your_sending_request') }}">Your Sending Request</a>
                        </ul>
                        @endif
                    </div>

                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_stock')}}">
                            @csrf
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-3">
                                            <div class="form-line">
                                                <label class="">Products</label>
                                                <select id="unit" class="form-control" name="product_id" value="">
                                                    <option value="" selected hidden disabled>{{ $stocks->product_name }}</option>
                                                </select>
                                            </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="">Available Quantity</label>
                                        <input type="number" value="{{ $stocks->qty }}" class="form-control" placeholder="Quantity" disabled name="qty" required>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="">Request Quantity From SR</label>
                                        <input type="number" value="{{ $stocks->request_quantity }}" class="form-control" placeholder="Quantity" disabled name="qty" required>
                                    </div>

                                    <div class="col-sm-3">
                                        <label class="">New Stock Quantity</label>
                                        <input type="number" value="{{ $stocks->request_quantity }}" class="form-control" placeholder="Quantity"  name="new_stock_qty" required>
                                    </div>


                                </div>
                                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
                            </div>

                        </form>
                    </div>



                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>
@endsection
