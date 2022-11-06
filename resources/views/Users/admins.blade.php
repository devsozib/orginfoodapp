@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Admins</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Admins

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('create_user') }}">Add Admins</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                <p class="alert-link">{{ session('error') }}</p>
                              </div>
                        @endif


                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>BRANCH</th>
                                    <th>EMAIL</th>
                                    <th>ROLE</th>
                                    <th>ACTION</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $user->user_name }}</td>
                                    <td>{{ $user->branch_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="float-left">
                                        <a class="btn btn-sm btn-info" href="{{ route('userEdit',$user->id)}}"> <i class="material-icons">edit_square</i>Edit</a>
                                        <a class="btn btn-sm btn-danger ml-2"> <i class="material-icons">delete</i>Delete</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>
@endsection
