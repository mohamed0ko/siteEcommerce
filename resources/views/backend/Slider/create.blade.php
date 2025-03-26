@extends('backend.Layout.master')

@section('contentAdmin')
    <form action="{{ route('backend.Slider.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="gig-gallery-container">
            <p class="title">Gig Gallery (Upload up to 5 images)</p>
            <p class="subtitle">Showcase your service with stunning visuals.</p>

            <div class="gig-gallery-preview">
                <div class="gig-image-item" id="imageContainer1">
                    <input type="file" id="image1" name="image1" class="hidden-input" accept="image/*"
                        onchange="previewImage(this, 'preview1', 'removeBtn1')">
                    <label for="image1" class="upload-label">
                        <img id="preview1" src="https://via.placeholder.com/120" alt="Upload Image">
                        <span class="upload-text">Click to upload</span>
                    </label>
                    <button type="button" class="remove-btn" id="removeBtn1" onclick="removeImage('1')"
                        style="display: none;">×</button>
                    <input type="text" id="title1" name="title1" class="image-title" placeholder="Enter image title">
                </div>

                <div class="gig-image-item" id="imageContainer2">
                    <input type="file" id="image2" name="image2" class="hidden-input" accept="image/*"
                        onchange="previewImage(this, 'preview2', 'removeBtn2')">
                    <label for="image2" class="upload-label">
                        <img id="preview2" src="https://via.placeholder.com/120" alt="Upload Image">
                        <span class="upload-text">Click to upload</span>
                    </label>
                    <button type="button" class="remove-btn" id="removeBtn2" onclick="removeImage('2')"
                        style="display: none;">×</button>
                    <input type="text" id="title2" name="title2" class="image-title" placeholder="Enter image title">
                </div>

                <div class="gig-image-item" id="imageContainer3">
                    <input type="file" id="image3" name="image3" class="hidden-input" accept="image/*"
                        onchange="previewImage(this, 'preview3', 'removeBtn3')">
                    <label for="image3" class="upload-label">
                        <img id="preview3" src="https://via.placeholder.com/120" alt="Upload Image">
                        <span class="upload-text">Click to upload</span>
                    </label>
                    <button type="button" class="remove-btn" id="removeBtn3" onclick="removeImage('3')"
                        style="display: none;">×</button>
                    <input type="text" id="title3" name="title3" class="image-title" placeholder="Enter image title">
                </div>

                <div class="gig-image-item" id="imageContainer4">
                    <input type="file" id="image4" name="image4" class="hidden-input" accept="image/*"
                        onchange="previewImage(this, 'preview4', 'removeBtn4')">
                    <label for="image4" class="upload-label">
                        <img id="preview4" src="https://via.placeholder.com/120" alt="Upload Image">
                        <span class="upload-text">Click to upload</span>
                    </label>
                    <button type="button" class="remove-btn" id="removeBtn4" onclick="removeImage('4')"
                        style="display: none;">×</button>
                    <input type="text" id="title4" name="title4" class="image-title"
                        placeholder="Enter image title">
                </div>

                <div class="gig-image-item" id="imageContainer5">
                    <input type="file" id="image5" name="image5" class="hidden-input" accept="image/*"
                        onchange="previewImage(this, 'preview5', 'removeBtn5')">
                    <label for="image5" class="upload-label">
                        <img id="preview5" src="https://via.placeholder.com/120" alt="Upload Image">
                        <span class="upload-text">Click to upload</span>
                    </label>
                    <button type="button" class="remove-btn" id="removeBtn5" onclick="removeImage('5')"
                        style="display: none;">×</button>
                    <input type="text" id="title5" name="title5" class="image-title"
                        placeholder="Enter image title">
                </div>
            </div>
            <br />
            <button type="submit" class="btn btn-primary">Create Slider</button>
        </div>
    </form>
@endsection
