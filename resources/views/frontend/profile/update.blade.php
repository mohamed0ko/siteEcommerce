@extends('frontend.profile.edit')
@section('contant_user')
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card">
            <h2>Avatar</h2>
            <div class="upload-section">
                <img class="avatar-placeholder" src="{{ asset('storage/' . $user->photo) }}" style="object-fit: cover;"
                    alt="">

                <div>
                    <input type="file" name="photo" id="photo" />
                    <p class="note">You can inject a little more personality into your profile by uploading an avatar.</p>
                </div>
            </div>
        </div>

        <div class="card">
            <h2>Profile</h2>

            <div style="margin-bottom: 15px;">
                <label for="name">First Name</label><br>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                    class="form-control" />
                <p class="note">This will only be used for verification and notification purposes.</p>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="lastname">Last Name</label><br>
                <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                    class="form-control" />
            </div>

            <div style="margin-bottom: 15px;">
                <label for="phone">Phone</label><br>
                <input type="text" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                    class="form-control" />
            </div>

            <div style="margin-bottom: 15px;">
                <label for="email">* Email Address</label><br>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                    class="form-control" />
            </div>

            <div style="margin-bottom: 15px;">
                <label for="address">Address</label><br>
                <textarea id="address" name="address" class="form-control" rows="4">{{ old('address', $user->address) }}</textarea>
            </div>

            <button type="submit" class="upload-btn">Save Changes</button>
        </div>
    </form>
@endsection
