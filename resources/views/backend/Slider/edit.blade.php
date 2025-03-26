@extends('backend.Layout.master')

@section('contentAdmin')
    <form action="{{ route('backend.Slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="gig-gallery-container">
            <p class="title">Gig Gallery (Upload up to 5 images)</p>
            <p class="subtitle">Showcase your service with stunning visuals.</p>

            <div class="gig-gallery-preview">
                @for ($i = 1; $i <= 5; $i++)
                    <div class="gig-image-item" id="imageContainer{{ $i }}">
                        <input type="file" id="image{{ $i }}" name="image{{ $i }}"
                            class="hidden-input" accept="image/*"
                            onchange="previewImage(this, 'preview{{ $i }}', 'removeBtn{{ $i }}')">
                        <label for="image{{ $i }}" class="upload-label">
                            @if ($slider->{'image' . $i})
                                <img id="preview{{ $i }}" src="{{ asset('storage/' . $slider->{'image' . $i}) }}"
                                    alt="Uploaded Image">
                            @else
                                <img id="preview{{ $i }}" src="https://via.placeholder.com/120"
                                    alt="Default Image">
                            @endif
                            <span class="upload-text">Click to upload</span>
                        </label>
                        <button type="button" class="remove-btn" id="removeBtn{{ $i }}"
                            onclick="removeImage('{{ $i }}')"
                            style="{{ $slider->{'image' . $i} ? '' : 'display: none;' }}">×</button>
                        <input type="text" id="title{{ $i }}" name="title{{ $i }}"
                            value="{{ $slider->{'title' . $i} }}" class="image-title" placeholder="Enter image title">
                    </div>
                @endfor
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Update Slider</button>
        </div>
    </form>
@endsection
