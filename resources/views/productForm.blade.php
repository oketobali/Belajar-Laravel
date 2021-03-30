@extends('home')
@section('data-content')
<div class="col-md-10">
    <div class="card">
        <div class="text-white card-header bg-secondary text-bold">
            @isset($productById)
                {{ 'UPDATE PRODUCT' }}
            @else
                {{ 'ADD PRODUCT' }}
            @endisset
        </div>

        <div class="card-body">

            @if ($errors->any())
                    <div class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <span>{{ $error }} </span><br/>
                        @endforeach
                    </div>
            @endif

            @isset($productById)
                <form method="POST" action="{{ route('product.update') }}">
                    <input type="hidden" name="id" value="{{ $productById->id }}">
            @else
                <form method="POST" action="{{ route('product.create') }}">
            @endisset

                @csrf
                <input type="hidden" name="created_by" value="{{ Auth::user()->id }}">
                <div class="form-group row">
                    <label for="product_name" class="col-md-4 col-form-label text-md-right">{{ __('Product Name') }}</label>
                    <div class="col-md-6">
                        <input id="product_name" type="text" class="form-control 
                            @error('product_name') is-invalid @enderror"
                            name="product_name"
                            value="{{ $productById->product_name ?? old('product_name') }}"
                            required autocomplete="name" autofocus
                        >

                        @error('product_name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_stock" class="col-md-4 col-form-label text-md-right">{{ __('Stock') }}</label>

                    <div class="col-md-6">
                        <input id="product_stock" type="number" min='1'
                        class="form-control @error('product_stock') is-invalid @enderror"
                        name="product_stock" value="{{ $productById->product_stock ?? old('product_stock') }}"
                        required autocomplete="number">

                        @error('product_stock')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_price" class="col-md-4 col-form-label text-md-right">{{ __('Product Price') }}</label>

                    <div class="col-md-6">
                        <input id="product_stock" type="number" min="1"
                        class="form-control @error('product_price') is-invalid @enderror"
                        name="product_price" value="{{ $productById->product_price ?? old('product_price') }}"
                        required autocomplete="number">

                        @error('product_price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="product_category" class="col-md-4 col-form-label text-md-right">{{ __('Product Category') }}</label>

                    <div class="col-md-6">
                        <select class="form-control form-select" name="category_id" id="product_category" required>
                            <option selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ ($productById->category_id ?? old('category_id')) == $category->id ? "selected" :""}}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Show this if updatting record-->
                @isset($productById)
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                    <div class="col-md-6">
                        <input id="description" type="text" min="10"
                        class="form-control @error('description') is-invalid @enderror"
                        name="description" value="{{ old('description') }}"
                        required autocomplete="description">

                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                @endisset

                <div class="mb-0 form-group row">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            @isset($productById)
                                {{  __('Update Product') }}
                            @else
                                {{ __('Add Product') }}
                            @endisset
                        </button>
                        <a href="{{ route('product') }}" class="btn btn-danger">
                            {{ __('Cancel') }}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
