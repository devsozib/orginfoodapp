@extends('layouts.app')
@section('content')
<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2> All Production</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Production

                        </h2>

                        @if (auth()->user()->role != 'super_admin')
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('add_production') }}">Add Production</a>
                        </ul>
                        @endif

                    </div>

                    <all-production></all-production>


                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>




@endsection
