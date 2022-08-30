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
               Make Due Payments
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Make Due Payments</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('materials_list') }}">Raw Materials Purchase List</a>
                        </ul>
                    </div>
                    <div class="body">

                        <form id="form_validation"  method="post" action="{{route('make_due_payment')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <input type="hidden" value="{{$vendor_id}}" name="vendor_id">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Amount</label>
                                            <input value="{{old('amount')}}" type="text" class="form-control" placeholder="Your amount" name="amount" required>
                                            @error('amount')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    </div>


                                    <div class="col-sm-6">
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
