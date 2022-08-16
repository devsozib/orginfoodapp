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
               Add Distributor
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Distributor</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('distributors') }}">All Distributor</a>
                        </ul>
                    </div>
                    <div class="body">

                        <form id="form_validation"  method="post" action="{{route('store_distributors')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Name</label>
                                            <input value="{{old('name')}}" type="text" class="form-control" placeholder="Name" name="name" required>
                                            @error('name')
                                            <span class="text-danger">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-line">
                                            <label class="form-label">SELECT SR</label>
                                            <select class="form-control" name="sr_id">
                                                <option value="">-- Please select --</option>
                                                @foreach ($srS as $sr)
                                                <option value="{{ $sr->id }}">{{ $sr->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-12">
                                    <div class=" form-float">
                                        <div class="form-line">
                                            <label class="">Address</label>
                                            <input type="text" {{old('address')}} class="form-control" placeholder="Address" name="address">
                                            @error('address')
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
