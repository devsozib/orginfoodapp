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
               Sale raw product
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Sale Raw Product</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('materials_list') }}">Raw Materials sales list</a>
                        </ul>
                    </div>
                    <div class="body">

                        <form id="form_validation"  method="post" action="{{route('raw_product_sale_store')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Raw Product Name</label>
                                            <select class="form-control" name="raw_product_id">
                                                <option value="" disabled selected hidden>-- Please select --</option>
                                                @foreach ($rawProducts as $item)
                                                <option value="{{ $item->id }}">{{ $item->proName }}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="form-label">Select Customer </label>
                                            <select class="form-control" name="consumer_id">
                                                <option value="" disabled selected hidden>-- Please select --</option>
                                                @foreach ($consumers as $consumer)
                                                <option value="{{ $consumer->id }}">{{ $consumer->name }}</option>
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

                                        {{-- <div class="col-sm-4">
                                            <div class=" form-float">
                                                <div class="form-line">
                                                    <label class="">Total Bill</label>
                                                    <input min="1" disabled value="0" type="number" class="form-control" >
                                                    @error('payment_amount')
                                                    <span class="text-danger">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                </div>
                                            </div>
                                            </div> --}}

                                            <div class="col-sm-4">
                                                <div class=" form-float">
                                                    <div class="form-line">
                                                        <label class="">Collection Payment Amount</label>
                                                        <input min="1" value="{{old('payment_amount')}}" type="number" class="form-control" placeholder="Collection_amount" name="collection_amount">
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
