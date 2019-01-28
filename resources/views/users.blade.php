@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">List users</div>

                    <div class="panel-body">
                        <ul>
                            @foreach($users as $user)
                            <li>{{ $user->name }} <a href="{{ url('admin/login-as/' . $user->id) }}">Loguearse como: {{ $user->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection