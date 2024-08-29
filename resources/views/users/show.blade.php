@extends('layouts.app')

@section('title', 'Users detail - ' . $user->name)

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Detail: {{ $user->name }}</strong></div>

                <div class="card-body">
                    <ul class="list-group">
                        <li class="list-group-item">Name: {{ $user->name }}</li>
                        <li class="list-group-item">Email: {{ $user->email }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
