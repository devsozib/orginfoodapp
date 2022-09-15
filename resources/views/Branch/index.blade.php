@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Branch</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Branch

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('add_branch_form') }}">Add Branch</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>Type</th>
                                    <th>Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($all_branches as $branch)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $branch->name }}</td>
                                    <td>{{ $branch->type }}</td>
                                    <td>{{ isset($branch->user->name)? $branch->user->name: "No Admin" }}</td>
                                    <td class="float-left">
                                        <a class="btn btn-sm btn-info" href="{{ route('branchEdit',$branch->id)}}"> <i class="material-icons">edit_square</i>Edit</a>
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
