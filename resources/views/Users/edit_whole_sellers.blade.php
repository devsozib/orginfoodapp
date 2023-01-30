@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Edit Whole Seller
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Whole Sellers</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('whole_sellers') }}">All Whole Sellers</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('updateWholeSeller',$whole_sellers->id)}}">
                            @csrf
                            @method('patch')
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="branch_id" value="{{ $whole_sellers->branch_id }}"/>
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" value="{{$whole_sellers->whole_seller_name}}" name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>


                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input  value="{{$whole_sellers->email}}" type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div id="myRow" class="row clearfix dNone">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Address</label>
                                            <input  value="{{$whole_sellers->address}}" id="address" type="text" class="form-control" placeholder="Address" name="address" >
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Phone</label>
                                                <input  value="{{$whole_sellers->phone}}" id="phone" type="text" class="form-control" placeholder="Phone" name="phone" >
                                            </div>
                                    </div>

                                </div>

                                <div class="row clearfix">

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Password</label>
                                                <input type="password" class="form-control" placeholder="New Password" name="password" required>

                                            </div>
                                    </div>

                                </div>
                            </div>
                            <button class="btn btn-primary waves-effect" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection

