@extends('layouts.app')

@section('title', 'Home')

@prepend('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.bootstrap5.css">
@endprepend

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <x-alert type="success">
                    {{ session('success') }}
                </x-alert>
            @endif
            <a href="{{ route('users.create') }}" class="btn btn-primary">Create User</a>
            <table id="example" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td class="d-flex gap-1">
                                <a href="{{ route('users.show', $user->id) }}" class="btn btn-primary">Show</a>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Edit</a>
                                <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.bootstrap5.js"></script>
    <script>
        new DataTable('#example');
    </script>
@endpush
