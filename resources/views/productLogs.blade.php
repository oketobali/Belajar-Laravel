@extends('home')
@section('data-content')
<div class="col-md-10">
    <div class="card">
        <div class="text-white card-header bg-secondary text-bold">PRODUCT LOGS</div>
            <div class="card-body">
                <table class="table table-responsive-md table-bordered table-condensed table-striped">
                    @if(count($productLogs) > 0)
                        <thead class="table-secondary">
                            <th>#</th>
                            <th>PRODUCT</th>
                            <th>STOCK</th>
                            <th>PRICE</th>
                            <th>DESCRIPTION</th>
                            <th>UPDATED BY</th>
                            <th>TIME</th>
                        </thead>
                        <tbody>
                                @foreach ($productLogs as $index => $log)
                                <tr>
                                    <td> {{ $index + $productLogs->firstItem() }} </td>
                                    <td> {{ $log->productName->product_name }} </td>
                                    <td> {{ $log->stock_update }} </td>
                                    <td> {{ $log->price_update }} </td>
                                    <td> {{ $log->description }} </td>
                                    <td> {{ $log->logCreator->name }} </td>
                                    <td> <span>{{ $log->created_at->diffForHumans() }} </span><br/>
                                         <span>at {{ $log->created_at->format('j F Y h:i:s A') }} </span>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    @else
                        Nothing Found!
                    @endif
                </table>
                {{ $productLogs->links() }}<!-- or {!! $productLogs->render() !!} -->
                Showing {{ $productLogs->firstItem() }} - {{ $productLogs->lastItem() }}
            </div> 
        </div>
    </div>
</div>
@endsection
