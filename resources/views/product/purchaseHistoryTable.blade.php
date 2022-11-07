<div class="container-fluid d-print-none" style="display: flex; justify-content: end;">
    <div class="">
        <a href="javascript:window.print()" class="btn btn-primary"><i class="material-icons">print</i>&nbsp;&nbsp;Print</a>
        {{-- <a onclick="ck()"  class="btn btn-light border text-black-50 shadow-none" id="download"><i class="fa fa-download"></i> Download</a> --}}
    </div>
</div>
<table class="table" >
    <thead>
        <tr>
            <th scope="col">#</th>
                @if(auth()->user()->role == 'super_admin')
                    <th  scope="col">BRANCH</th>
                @endif
            <th scope="col">PRODUCT</th>
            <th scope="col">Qty</th>
            <th scope="col">date</th>

        </tr>
    </thead>
    <tbody>

    @foreach ($stockinHistories as $item)
        <tr>
            <th scope="row">{{ $loop->index+1 }}</th>
                @if(auth()->user()->role == 'super_admin')
                    <td>{{ $item->branch_name }}</td>
                @endif

            <td>{{ $item->name.'-'.$item->grade_name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->created_at }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
