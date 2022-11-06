@php
    $totalPrice = 0;
    $totalCollected = 0;
    $totalPaied = 0;
@endphp

<div class="container-fluid" style="display: flex; justify-content: end;">
    <div class="btn-group btn-group-sm d-print-none">
        <a href="javascript:window.print()" class="btn btn-primary border text-black-50 shadow-none"><i class="fa fa-print"></i> Print</a>
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
            <th scope="col" >PRODUCT</th>
            <th scope="col">DISTRIBUTOR</th>
            <th scope="col">Request Qty</th>
            <th scope="col">Price <span style="font-size: 10px; text-style: none;">(Per Unit)</span> </th>
            <th scope="col">Total</th>
            <th scope="col">Collected</th>
            <th scope="col">Paied</th>
            <th scope="col">date</th>

        </tr>
    </thead>
    <tbody>

    @foreach ($orders as $item)
        @php
            $totalPrice += ($item->qty *  $item->price);
            $totalCollected += $item->collected_amount;
            $totalPaied += $item->paid_amount;
        @endphp
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
            @if(auth()->user()->role == 'admin' or auth()->user()->role == 'super_admin')
                @if(auth()->user()->role == 'super_admin')
                    <td>{{ $item->branch_name }}</td>
                @endif
                <td >{{ $item->sr_name }}</td>
            @endif

            <td>{{ $item->product_name }}</td>
            <td>{{ $item->distributor_name }}</td>

            <td>{{ $item->qty }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->qty *  $item->price}}</td>
            <td>{{$item->collected_amount}}</td>
            <td>{{$item->paid_amount}}</td>
            <td>{{ $item->date }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
<p class="text-end" style="text-align: end;">Total Price: {{$totalPrice}}</p>
<p class="text-end" style="text-align: end;">Total Collected: {{$totalCollected}}</p>
<p class="text-end" style="text-align: end;">Total Paied: {{$totalPaied}}</p>
