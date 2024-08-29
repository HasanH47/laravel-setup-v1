@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Dashboard</strong></div>
                <div class="card-body">
                    @if (session('success'))
                        <x-alert type="success">
                            {{ session('success') }}
                        </x-alert>
                    @endif
                    <div class="alert alert-success">
                        Hello, {{ Auth::user()->name }}, You are logged in!
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
