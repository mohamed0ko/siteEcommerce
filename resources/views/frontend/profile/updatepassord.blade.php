@extends('frontend.profile.edit')
@section('contant_user')
    <div class="card">
        <h1>Change Password</h1>

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" id="current_password" name="current_password">
            </div>

            <div class="form-group">
                <label for="new-password">New Password</label>
                <input type="password" id="new-password" name="new-password">
                <div class="password-strength">Password Strength: Empty</div>
            </div>
            <div class="form-group">
                <label for="new-password">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation">

            </div>

            <button type="submit" class="upload-btn">Change Password</button>
        </form>
    @endsection
