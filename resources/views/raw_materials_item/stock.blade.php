@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Raw Materials Item Stock</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Raw Materials Item Stock

                        </h2>

                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('create_raw_materials') }}">Add Raw Materials Item</a>
                        </ul>


                    </div>
                    <div class="body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    @if (auth()->user()->role == "super_admin")
                                    <th>Branch</th>
                                    @endif
                                    <th>Qty</th>
                                    <th>Unit</th>
                                </tr>
                            </thead>
                            <tbody>

                            @foreach ($materials_Stock as $item)
                                <tr>
                                    <th scope="row">{{ $loop->index+1 }}</th>
                                    <td>{{ $item->materials_name }}</td>
                                    @if (auth()->user()->role == "super_admin")
                                    <td>{{ $item->branch_name }}</td>
                                    @endif
                                    <td>{{ $item->qty }}</td>
                                    <td>{{ $item->unit }}</td>

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
