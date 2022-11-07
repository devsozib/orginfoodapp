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

            <td>{{ $item->name }}</td>
            <td>{{ $item->qty }}</td>
            <td>{{ $item->created_at->format('d M Y') }}</td>

        </tr>
    @endforeach
    </tbody>
</table>
