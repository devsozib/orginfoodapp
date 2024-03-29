@extends('layouts.app')
@section('content')
@if ($user_type == 'admin')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Add Admin
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Admin</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('all_admin') }}">All Admin</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_admin')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="" selected hidden disabled>-- Please select --</option>
                                            @foreach ($branches as $branch)


                                                <option value="{{$branch->id}}">{{$branch->name}}</option>


                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (session('branch_id'))
                                            <span class="text-dangar" role="alert">
                                                <strong>{{ session('branch_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>





                                </div>


                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password" required>

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
@elseif($user_type=='sr')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Add SR
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add SR</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('all_srs') }}">All SR'S</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_sr')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="" selected hidden disabled>-- Please select --</option>
                                            @foreach ($branches_for_sr as $branch)
                                             @if ($branch->type == "wirehouse")
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (session('branch_id'))
                                            <span class="text-dangar" role="alert">
                                                <strong>{{ session('branch_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div id="myRow" class="row clearfix dNone">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Address</label>
                                            <input id="address" type="text" class="form-control" placeholder="Address" name="address" >
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Phone</label>
                                                <input id="phone" type="text" class="form-control" placeholder="Phone" name="phone" >
                                            </div>
                                    </div>

                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password" required>

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
@else
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Add Whole Seller
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Whole Seller</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('whole_sellers') }}">All Whole Seller</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_whole_seller')}}">
                            @csrf
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <label class="form-label">Branch</label>
                                        <select class="form-control" name="branch_id">
                                            <option value="" selected hidden disabled>-- Please select --</option>
                                            @foreach ($branches_for_sr as $branch)
                                             @if ($branch->type == "wirehouse")
                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                        @if (session('branch_id'))
                                            <span class="text-dangar" role="alert">
                                                <strong>{{ session('branch_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                </div>

                                <div id="myRow" class="row clearfix dNone">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Address</label>
                                            <input id="address" type="text" class="form-control" placeholder="Address" name="address" >
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Phone</label>
                                                <input id="phone" type="text" class="form-control" placeholder="Phone" name="phone" >
                                            </div>
                                    </div>

                                </div>

                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Password</label>
                                                <input type="password" class="form-control" placeholder="Password" name="password" required>

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
@endif



@endsection
