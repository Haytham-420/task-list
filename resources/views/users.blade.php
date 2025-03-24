@extends('layouts.app')
@section('content')
    <div class="container mt-4">
        <h1>User List</h1>
        <div class="offset-md-2 col-md-8">
            <div class="card">
                @if (isset($user))
                    <div class="card-header">
                        Update User
                    </div>
                    <div class="card-body">
                        <!-- Update User Form -->
                        {{-- This is called relative route url('update') --}}
                        <form action="{{ url('user/update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="user-name" class="form-label">Name</label>
                                <input type="text" name="name" id="user-name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- User Email -->
                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email</label>
                                <input type="email" name="email" id="user-email"
                                    class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- User Password -->
                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" name="password" id="user-password"
                                    class="form-control @error('password') is-invalid @enderror">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="user-password-confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="user-password-confirmation"
                                    class="form-control">
                            </div>

                            <!-- Update User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i>Update User
                                </button>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card-header">
                        New User
                    </div>
                    <div class="card-body">
                        <!-- New User Form -->
                        <form action="user/create" method="POST">
                            @csrf

                            <!-- User Name -->
                            <div class="mb-3">
                                <label for="user-name" class="form-label">Name</label>
                                <input type="text" name="name" id="user-name"
                                    class="form-control @error('name') is-invalid @enderror" value="">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- User Email -->
                            <div class="mb-3">
                                <label for="user-email" class="form-label">Email</label>
                                <input type="email" name="email" id="user-email"
                                    class="form-control @error('email') is-invalid @enderror" value="">
                            </div>
                            @error('email')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- User Password -->
                            <div class="mb-3">
                                <label for="user-password" class="form-label">Password</label>
                                <input type="password" name="password" id="user-password"
                                    class="form-control @error('password') is-invalid @enderror">
                            </div>
                            @error('password')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="user-password-confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="user-password-confirmation"
                                    class="form-control">
                            </div>

                            <!-- Add User Button -->
                            <div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i>Add User
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>

            <!-- Current Users -->
            <div class="card mt-4">
                <div class="card-header">
                    Current Users
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <form action="user/delete/{{ $user->id }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fa fa-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                        <form action="user/edit/{{ $user->id }}" method="GET" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-info">
                                                <i class="fa fa-info me-2"></i>Update
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection