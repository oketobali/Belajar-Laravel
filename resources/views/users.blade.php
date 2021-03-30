@extends('home')
@section('data-content')
<div class="col-md-10">
    <div class="card">
        <div class="text-white card-header bg-secondary text-bold">USERS</div>
            <div class="card-body">
                <table class="table table-bordered table-condensed table-striped">
                    @if (count($users) > 0)
                        <thead>
                            <th>NO</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>ACTION</th>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td> {{ $user->id }} </td>
                                <td> {{ $user->name }} </td>
                                <td> {{ $user->email }} </td>
                                <td class='btn-toolbar'> 
                                    <a href='#' class='btn btn-primary btn-sm'> Edit </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST">
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
            </div>
        </div>
    </div>
</div>
@endsection
