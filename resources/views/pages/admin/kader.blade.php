@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="container-fluid p-0">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-0 h-100 d-flex justify-content-center align-items-center">
                    <div class="card-body w-97">
                        <h5 class="card-title text-center">User Profile</h5>
                        <form method="POST" action="{{ route('profile.update') }}" id="update_profile"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 text-center">
                                @if ($user->image)
                                    <img src="{{ getFileInfo($user->image)['preview'] }}"
                                        class="img-fluid" style="max-width: 200px;" alt="Profile Halo" />
                                @else
                                    <p>No image uploaded</p>
                                @endif
                                <input type="file" class="form-control mt-3" id="image" name="image">
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
