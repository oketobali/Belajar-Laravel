@extends('layouts.app')
@section('content')

<div class="row">
    <video width="100%" style="margin-top: -15em; opacity: .4; z-index: -99999; position: absolute;" poster="https://laravel.com/img/hero/hero_poster.jpg" playsinline="" autoplay="" muted="" loop="" __idm_id__="335104001">
        <source src="https://laravel.com/img/hero/hero.mp4" type="video/mp4">
    </video>
    <div class="col-md-2">
      <div class="card">
        <div class="text-white card-header bg-secondary text-bold">DASHBOARD</div>
        <div class="card-body">
            <div class="list-group list-group-flush">
                <a href="{{ route('users') }}" class="list-group-item list-group-item-action">User</a>
                <a href="{{ route('product') }}" class="list-group-item list-group-item-action">Product</a>
                <a href="{{ route('productLogs') }}" class="list-group-item list-group-item-action">Product Logs</a>
            </div>
        </div>
      </div>
    </div>

    @yield('data-content')

  <!---  <div class="col-md-10">
      <div class="card">
        <div class="card-header">WELCOME</div>
        <div class="card-body">

        </div>
      </div>
    </div>
  </div> -->

@endsection
