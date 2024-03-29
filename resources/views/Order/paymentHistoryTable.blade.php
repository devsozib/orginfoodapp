
<div class="container-fluid d-print-none" style="display: flex; justify-content: end;">
    <div class="">
        <a href="javascript:window.print()" class="btn btn-primary"><i class="material-icons">print</i>&nbsp;&nbsp;Print</a>
        {{-- <a onclick="ck()"  class="btn btn-light border text-black-50 shadow-none" id="download"><i class="fa fa-download"></i> Download</a> --}}
    </div>
</div>
<table class="table" >
    <thead class="">
        <tr>
            <th scope="col">#</th>
            @if(auth()->user()->role == 'admin' || auth()->user()->role == 'super_admin')
                @if(auth()->user()->role == 'super_admin')
                    <th  scope="col">BRANCH</th>
                @endif
                <th  scope="col">SR</th>
            @endif
            <th scope="col">PRODUCT</th>
            <th scope="col">DISTRIBUTOR</th>
            <th scope="col">R Qty</th>
            <th scope="col">Unit Price</span> </th>
            <th scope="col">Total</th>
            <th scope="col">Due</th>
            <th scope="col">Paid</th>
            <th scope="col">Payment Type</th>
            <th style="text-align: right" scope="col">date</th>

        </tr>
    </thead>
    <tbody>

    @foreach ($orders as $item)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            @if(auth()->user()->role == 'admin' or auth()->user()->role == 'super_admin')
                @if(auth()->user()->role == 'super_admin')
                    <td>{{ $item->branch_name }}</td>
                @endif
                <td >{{ $item->sr_name }}</td>
            @endif

            <td>{{ $item->product_name.'-'.$item->grade_name }}</td>
            <td>{{ $item->distributor_name }}</td>

            <td>{{ $item->qty }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty *  $item->price}}</td>
            <td>{{($item->qty *  $item->price)-$item->paid_amount}}</td>
            <td>{{$item->paid_amount}}</td>
            <td>{{$item->payment_type}}</td>
            <td style="text-align: right">{{ $item->date }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
