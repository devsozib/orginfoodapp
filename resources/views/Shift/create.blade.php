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
               Add Stock
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Shif Stock</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('shift_product') }}">Shif Stocks</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('shift_product_store')}}">
                            @csrf
                            <div class="body">
                                <div class="row clearfix">


                                    <div class="col-sm-4">
                                            <div class="form-line">
                                                <label class="">Products</label>
                                                <select id="unit" class="form-control" name="product_id" value="">
                                                    <option value="" selected hidden disabled>-- Please select --</option>
                                                    @foreach ($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="">Branch</label>
                                            <select id="unit" class="form-control" name="branch_id" value="">
                                                <option value="" selected hidden disabled>-- Please select --</option>
                                                @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                </div>
                                    <div class="col-sm-4">
                                        <label class="">Quantity</label>

                                        <input type="number" class="form-control" placeholder="Quantity" name="qty" required>
                                        @error('qty')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (session('error_qty'))

                                            <span class="text-danger" >
                                                <strong>{{ session('error_qty') }}</strong>
                                            </span>
                                        @endif
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
