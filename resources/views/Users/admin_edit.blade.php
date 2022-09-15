@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
               Edit Admin
            </h2>
        </div>
        <!-- Basic Validation -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>Edit Admin</h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('users') }}">All User</a>
                        </ul>
                    </div>
                    <div class="body">
                        <form id="form_validation"  method="post" action="{{route('updateAdmin',$admin->id)}}">
                            @csrf
                            @method('patch')
                            <div class="body">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                            <div class="form-line">
                                                <label class="">Name</label>
                                                <input type="text" class="form-control" placeholder="Name" value="{{ $admin->name }}" name="name" required>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                    </div>

                                    {{-- <div class="col-sm-6">
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
                                    </div> --}}

                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="">Email</label>
                                            <input type="email" class="form-control" placeholder="Email" value="{{ $admin->email }}" name="email" required>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-line">
                                            <label class="">Password</label>
                                            <input type="password" class="form-control" placeholder="New Password"  name="password" required>

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
