@extends('layouts.app')
@section('title')
    <title>Profile</title>
@endsection

@section('content')
    <div class="content-wrapper py-5 px-3 px-md-5">
        <div class="container">
            <div class="card shadow-sm border-0">
                <div class="card-body">
                    <h4 class="mb-4 text-center">Update Profile</h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profileUpdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="d-flex justify-content-center mb-4">
                            <div class="position-relative" style="width: 120px;">
                                @php
                                    $image = Auth::user()->profile_image
                                        ? asset('storage/' . Auth::user()->profile_image)
                                        : asset('images/placeholder.png');
                                @endphp

                                <img id="profile-preview" src="{{ $image }}" class="rounded-circle border" style="width: 120px; height: 120px; object-fit: cover;" alt="Profile">

                                <label for="image" class="position-absolute bottom-0 end-0 translate-middle d-flex justify-content-center align-items-center bg-dark bg-opacity-75 shadow rounded-circle"
                                       style="width: 36px; height: 36px; cursor: pointer;" title="Change photo">
                                    <i class="bi bi-pencil-fill text-white fs-5"></i>
                                </label>
                                <input type="file" name="image" id="image" class="d-none" onchange="previewImage(event)">
                            </div>
                        </div>

                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', Auth::user()->name) }}"
                                   required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email (read-only) -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control"
                                   value="{{ Auth::user()->email }}"
                                   readonly>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password <small class="text-muted">(optional)</small></label>
                            <input type="password"
                                   name="password"
                                   id="password"
                                   autocomplete="new-password"
                                   class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password"
                                   name="password_confirmation"
                                   id="password_confirmation"
                                   autocomplete="new-password"
                                   class="form-control">
                        </div>


                        <!-- Submit Button -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary px-4">Update Profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Preview Script -->
@endsection
@section('scripts')
    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const preview = document.getElementById('profile-preview');
                preview.src = reader.result;  // Update the preview with the selected image
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
@endsection
