@extends('layouts.app')
@section('content')

<section class="">
    <div class="container-fluid">
        <div class="block-header">
            <h2>All Order Status</h2>


        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                           All Order Status
                        </h2>
                        @if (auth()->user()->role == "sr")
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right"href="{{ route('order_place') }}">Place Order</a>
                        </ul>
                        @endif

                    </div>
                    <div class="body" id="order_table">
                        <div class="table-responsive">
                            <table class="table" >
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th  scope="col">Collected Amount</th>
                                        <th scope="col">Paid Amount</th>
                                        <th  scope="col">Date</th>

                                    </tr>
                                </thead>
                                <tbody>

                                @forelse($paymentHistories as $item)
                                    <tr>
                                        <th scope="row">{{ $loop->index+1 }}</th>
                                        <td colspan="1">{{ $item->collected_amount }}</td>
                                        <td colspan="1">{{ $item->paid_amount }}</td>
                                        <td>{{ $item->date }}</td>

                                    </tr>
                                    @empty
                                    <tr>
                                        <th class="text-danger text-center" colspan="8">No Payment History</th>

                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
</section>

<script type="text/javascript">

</script>
@endsection
