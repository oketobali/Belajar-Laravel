@extends('home')
@section('data-content')
<div class="col-md-10">
    <div class="card">
        <div class="text-white card-header bg-secondary text-bold">
            PRODUCTS
            <a href='{{ route('product.form') }}' class="float-right btn btn-sm btn-primary">Add Product</a>
        </div>
        <div class="card-body">

            @if(session()->get('message'))
            <div class="alert alert-dark">
                <button type="button" class="close" data-dismiss="alert">×</button>
                {{ session()->get('message') }}
            </div>
            @endif


            <table class="table table-responsive-md table-condensed table-hover table-bordered table-striped">
                @if (count($products) > 0)
                    <thead class="table-secondary">
                        <tr>
                            <th>#</th>
                            <th>PRODUCT</th>
                            <th>STOCK</th>
                            <th>PRICE</th>
                            <th>CATEGORY</th>
                            <th>CREATED BY</th>
                            <th>UPDATED AT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $index => $product)
                        <tr>
                            <td> {{ $index + $products->firstItem() }} </td>
                            <td> {{ $product->product_name }} </td>
                            <td> {{ $product->product_stock }} </td>
                            <td> {{ $product->product_price }} </td>
                            <td> {{ $product->category->category }} </td>
                            <td> {{ $product->creator->name }} </td>
                            <td> {{ $product->updated_at->diffForHumans() }} </td>
                            <td class='btn-toolbar'>
                                <a href='{{ route('product.form', ['id'=>$product->id]) }}' class='btn btn-primary btn-sm'> Edit </a>
                                <form action="{{ route('product.destroy', $product->id) }}" method="GET">
                                    @csrf
                                <button class='btn btn-danger btn-sm' type="submit"> Delete </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                @else
                    Nothing Found!
                @endif
            </table>

            {{ $products->links() }}<!-- or {!! $products->render() !!} -->
            Showing {{ $products->firstItem() }} - {{ $products->lastItem() }}

         </div>
    </div>
</div>
@endsection



