@extends('frontend.Layouts.master')
@section('content')
    <div class="container">
        <div class="header">
            <h2>Profile</h2>
        </div>
        <div class="container">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Profile</h2>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-6">
                                <label for="name" class="form-label">First Name</label>
                                <input type="text" id="name" name="name" class="form-input"
                                    value="{{ old('name', $user->name) }}" required>
                            </div>

                            <!-- Last Name -->
                            <div class="mb-6">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" id="lastname" name="lastname" class="form-input"
                                    value="{{ old('lastname', $user->lastname) }}">
                            </div>

                            <!-- Phone -->
                            <div class="mb-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" id="phone" name="phone" class="form-input"
                                    value="{{ old('phone', $user->phone) }}">
                            </div>

                            <!-- Address -->
                            <div class="mb-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" id="address" name="address" class="form-input"
                                    value="{{ old('address', $user->address) }}">
                            </div>

                            <!-- Email -->
                            <div class="mb-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-input"
                                    value="{{ old('email', $user->email) }}" required>
                            </div>
                            <!-- Photo -->
                            <div class="mb-6">
                                <label for="photo" class="form-label">Profile Photo</label>
                                <input type="file" id="photo" name="photo" class="form-input">
                                @if ($user->photo)
                                    <img style="border-radius: 10px; width: 80px; height: 80px; object-fit: cover;"
                                        src="{{ asset('storage/' . $user->photo) }}" alt="Profile Photo" class="mt-2"
                                        width="100">
                                @endif
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Update Password</h3>
            </div>
            <!-- Password Update Form (Replace with actual form content) -->
            <div class="form-section">
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    @method('PUT')

                    <div class="form-section">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" id="current_password" name="current_password" class="form-input" required>
                    </div>

                    <div class="form-section">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                    </div>

                    <div class="form-section">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input"
                            required>
                    </div>

                    <button type="submit" class="btn">Update Password</button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Delete Account</h3>
            </div>
            <!-- Delete Account Form (Replace with actual form content) -->
            <div class="form-section">
                <form method="POST" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="form-section">
                        <label for="password" class="form-label">Confirm Password</label>
                        <input type="password" id="password" name="password" class="form-input" required>
                    </div>

                    <button type="submit" class="btn" style="background-color: #e53e3e; color: white;">Delete
                        Account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
