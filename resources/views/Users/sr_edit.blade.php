@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Edit SR
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit SR</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('users') }}">All Users</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('updateSr',$sr->id)}}">
                            @csrf
                            @method('patch')
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-6">
                                        <input type="hidden" name="branch_id" value="{{ $sr->branch_id }}"/>
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" value="{{$sr->srs_name}}" name="name" required>
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
                                            <input  value="{{$sr->email}}" type="email" class="form-control" placeholder="Email" name="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div id="myRow" class="row clearfix dNone">
                                    <div class="col-sm-6">
                                        <div class="form-line">
                                            <label class="">Address</label>
                                            <input  value="{{$sr->address}}" id="address" type="text" class="form-control" placeholder="Address" name="address" >
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                            <div class="form-line">
                                                <label class="">Phone</label>
                                                <input  value="{{$sr->phone}}" id="phone" type="text" class="form-control" placeholder="Phone" name="phone" >
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

<script>
    // function setInputField(){
    //     role  = document.getElementById('role').value;
    //     if(role == 'sr'){
    //         document.getElementById('myRow').classList.remove('dNone');
    //         document.getElementById("address").required = true;
    //         document.getElementById("phone").required = true;
    //     }else{
    //         document.getElementById('myRow').classList.add('dNone');
    //         document.getElementById("address").removeAttribute('required');
    //         document.getElementById("phone").removeAttribute('required');
    //     }
    // }
    // setInputField();
</script>
@endsection
