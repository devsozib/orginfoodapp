@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Distributor</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Distributor

                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('create_distributors') }}">Add Distributor</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>SR</th>
                                    <th>ADDRESS</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($distributors as $distributor)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $distributor->name }}</td>
                                    <td>{{ $distributor->sr_id }}</td>
                                    <td>{{ $distributor->address }}</td>
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
