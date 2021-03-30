
<div class="col-md-2">
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                   <!-- {{ __('You are logged in!') }} -->

                <!-- adding menus -->
                <div class="list-group list-group-flush">
                    <a href="{{ route('users') }}" class="list-group-item list-group-item-action">User</a>
                    <a href="{{ route('product') }}" class="list-group-item list-group-item-action">Product</a>
                    <a href="{{ route('productLogs') }}" class="list-group-item list-group-item-action">Product Logs</a>
                </div>

            </div>

        </div>
    </div>
</div>


      <!--  @yield('users-content')
        @yield('products-content')
        @yield('logs-content')
        @yield('add-product-form') -->

