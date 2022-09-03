@extends('layouts.app')
@section('content')
{{-- <div>
    <form method="post" action="{{route('add_branch')}}">
        @csrf

        <input type="text" name="name" placeholder="name">

        <select name="type" id="ff">
            <option value="" selected hidden disabled>--Select Factory--</option>
            <option value="factory">Factory</option>
            <option value="outlet_branch">Outlet Branch</option>
        </select>

    <button type="submit">Submit</button>
    </form>
</div> --}}


<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Purchase Raw Materials
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> Purchase Raw Materials</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('materials_list') }}">Raw Materials Purchase List</a>
                        </ul>
                    </div>
                    <div class="body">

                        <form id="form_validation"  method="post" action="{{route('purchase_raw_materials')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Item Name</label>
                                            <select class="form-control" name="materials_item_id">
                                                <option value="" disabled selected hidden>-- Please select --</option>
                                                @foreach ($raw_materials_items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="form-label">SELECT VENDOR</label>
                                            <select class="form-control" name="vendor_id">
                                                <option value="" disabled selected hidden>-- Please select --</option>
                                                @foreach ($vendors as $vendor)
                                                <option value="{{ $vendor->id }}">{{ $vendor->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class=" form-float">
                                            <div class="form-line">
                                                <label class="">Date</label>
                                                <input value="{{old('date')}}" type="date" class="form-control" placeholder="Name" name="date" required>
                                                @error('date')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        </div>
                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Quantity</label>
                                            <input min="1" value="{{old('quantity')}}" type="number" class="form-control" placeholder="Quantity" name="qty" required>
                                            @error('qty')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class=" form-float">
                                            <div class="form-line">
                                                <label class="">Price</label>
                                                <input min="1" value="{{old('price')}}" type="number" class="form-control" placeholder="Price" name="price" required>
                                                @error('price')
                                                <span class="text-danger">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            </div>
                                        </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class=" form-float">
                                                <div class="form-line">
                                                    <label class="">Payment Amount</label>
                                                    <input min="1" value="{{old('payment_amount')}}" type="number" class="form-control" placeholder="Payment Amount" name="payment_amount">
                                                    @error('payment_amount')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
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
