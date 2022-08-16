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
               Add Users
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Users</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('users') }}">All Users</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('store_user')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label class="">Name</label>
                                            <input type="text" class="form-control" placeholder="Name" name="name" required>

                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">

                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" name="email" required>

                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <label class="">Password</label>
                                            <input type="password" class="form-control" placeholder="Name" name="password" required>

                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="form-label">Type of Role</label>
                                        <select class="form-control" name="role">
                                            <option value="">-- Please select --</option>
                                            <option value="admin">Admin</option>
                                            <option value="sr">SR</option>
                                        </select>
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
