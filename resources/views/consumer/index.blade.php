@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Consumer</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Consumers

                        </h2>
                        @if(auth()->user()->role == 'super_admin' || auth()->user()->role == 'admin')
                            <ul class="header-dropdown m-r--5">
                                <a class="btn-sm btn-primary float-right"href="{{ route('create_consumer') }}">Add Consumer</a>
                            </ul>
                        @endif
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    @if (auth()->user()->role == 'super_admin')
                                    <td>Branch Name</td>
                                    @endif
                                    <td>Address</td>
                                    <td>Phone</td>
                                </tr>
                            </thead>
                            <tbody>


                            @foreach ($consumers as $consumer)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $consumer->name }}</td>
                                    @if (auth()->user()->role == "super_admin")
                                    <td>{{ $consumer->branch_id }}</td>
                                    @endif
                                    <td>{{ $consumer->address }}</td>
                                    <td>{{ $consumer->phone }}</td>
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
