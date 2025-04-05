@extends('frontend.Layouts.master')
@section('content')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/Home"><i class="fa fa-home"></i> Home</a>
                        <span>Contact</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">

        <div class="container">
            @foreach ($ContactInfo as $C_info)
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="contact__content">
                            <div class="contact__address">

                                <h5>Contact info</h5>
                                <ul>
                                    <li>
                                        <h6><i class="fa fa-map-marker"></i> Address</h6>
                                        <p>{{ $C_info->address }}</p>
                                    </li>
                                    <li>
                                        <h6><i class="fa fa-phone"></i> Phone</h6>
                                        <p><span>{{ $C_info->phone }}</span><span>{{ $C_info->phone2 }}</span></p>
                                    </li>
                                    <li>
                                        <h6><i class="fa fa-headphones"></i> Support</h6>
                                        <p>{{ $C_info->support }}</p>
                                    </li>
                                </ul>

                            </div>
                            <div class="contact__form">
                                <h5>SEND MESSAGE</h5>
                                <form action="{{ route('frontend.Contact.store') }}" method="POST">
                                    @csrf
                                    <input type="text" value="{{ old('full_name') }}" name="full_name"
                                        placeholder="Full Name">
                                    <input type="text" value="{{ old('email') }}" name="email" placeholder="Email">
                                    <input type="text" value="{{ old('subject') }}" name="subject" placeholder="Subject">
                                    <textarea name="message" placeholder="Message">{{ old('message') }}</textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">

                        <div class="contact__map">
                            <iframe src="{{ $C_info->contact__map }}" height="780" style="border:0"
                                allowfullscreen></iframe>
                            <p>If the map is not loading, please <a href="{{ $C_info->contact__map }}"
                                    target="_blank">click here</a> to view the map directly.</p>
                        </div>

                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
