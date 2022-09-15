@extends('layouts.app')
@section('content')



<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Add Branch

            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Add Branch</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('branches') }}">All Branches</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('add_branch')}}">
                            @csrf

                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Branch Name</label>
                                            <input type="text" class="form-control" placeholder="Branch Name" name="name" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">

                                        <label class="form-label">Type of Branch</label>
                                        <select class="form-control" name="type">
                                            <option value="" selected hidden disabled>-- Please select --</option>
                                            <option value="factory">Factory</option>
                                            <option value="wirehouse">Wirehouse</option>
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
