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
               Add Production
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Production</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('production') }}">All Production</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_production')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                            <div class="form-line">
                                                <label class="form-label">Product</label>
                                                <select id="product_id" class="form-control" name="product_id" value="">
                                                    <option value="" selected hidden disabled>--Select Product--</option>
                                                    @foreach ($products as $product)
                                                        <option value="{{$product->id}}">{{ $product->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                    </div>





                                    <div class="col-sm-4">
                                        <label class="">Qty</label>
                                        <input type="number" class="form-control" placeholder="Qty" name="qty" required>
                                        @error('gty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                    </div>

                                    <div class="col-sm-4">
                                        <label class="">Date</label>
                                        <input type="date" class="form-control" placeholder="Date" name="date" required>
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

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
