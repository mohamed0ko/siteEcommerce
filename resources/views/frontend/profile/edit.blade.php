@extends('frontend.Layouts.master')
@section('content')
    <div class="container2">
        <!-- Sidebar -->


        <aside>
            <div class="section-title">ACCOUNT SETTINGS</div>
            <div class="menu">
                <a class="nav-link" href="/profile" class="active">Edit Profile</a>
                <a class="nav-link" href="{{ route('profile.change-passord') }}">Change Password</a>
                <a class="nav-link" href="{{ route('profile.delete-account') }}">Cancel Account</a>
            </div>

        </aside>

        <!-- Main Content -->

        <main>
            @yield('contant_user')
        </main>

        <!-- Profile Form -->



    </div>
@endsection
