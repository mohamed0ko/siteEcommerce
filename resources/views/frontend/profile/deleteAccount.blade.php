@extends('frontend.profile.edit')
@section('contant_user')
    <div class="card">

        <h2>Delete Account</h2>

        <!-- Delete Account Form (Replace with actual form content) -->
        <div class="form-section">
            <form method="POST" action="{{ route('profile.destroy') }}">
                @csrf
                @method('DELETE')

                <div class="form-section">
                    <label for="password" class="form-label">Confirm Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div><br>

                <button type="submit" class="upload-btn">Delete
                    Account</button>
            </form>
        </div>
    </div>
@endsection
