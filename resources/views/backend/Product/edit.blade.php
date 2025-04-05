@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">
        <form action="{{ route('backend.Product.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Product Name</label>
                                <input type="text" id="name" name="name"
                                    value="{{ old('name', $product->name) }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id" class="form-control custom-select">
                                    <option disabled {{ is_null($product->category_id) ? 'selected' : '' }}>Select one
                                    </option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id" class="form-control custom-select">
                                    <option disabled {{ is_null($product->brand_id) ? 'selected' : '' }}>Select one
                                    </option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand_id->id }}"
                                            {{ old('category_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                            {{ $brand->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Color</label>
                                @foreach ($colors as $color)
                                    <div>
                                        <label>
                                            <input type="checkbox" name="color_id[]" value="{{ $color->id }}"
                                                {{ in_array($color->id, isset($product) ? $product->colors->pluck('id')->toArray() : []) ? 'checked' : '' }}>
                                            {{ $color->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select id="status" name="status" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option value="1"
                                        {{ old('status', $product->status ?? '') == 1 ? 'selected' : '' }}>
                                        Enable</option>
                                    <option value="0"
                                        {{ old('status', $product->status ?? '') == 0 ? 'selected' : '' }}>
                                        Disable</option>
                                </select>
                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="size">Sizes</label>
                                <div id="size-container">
                                    @php
                                        // Check if $product->size is a string, and only then decode it
                                        $sizes = is_string($product->size)
                                            ? json_decode($product->size, true)
                                            : $product->size ?? [];
                                    @endphp

                                    @if (count($sizes))
                                        @foreach ($sizes as $size)
                                            <div class="input-group mb-2">
                                                <input type="text" name="size[]" value="{{ $size }}"
                                                    class="form-control" placeholder="Enter size">
                                                <button type="button" class="btn btn-danger remove-size">-</button>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" name="size[]" class="form-control"
                                                placeholder="Enter size">
                                            <button type="button" class="btn btn-danger remove-size">-</button>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" class="btn btn-success add-size">+</button>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity"
                                    value="{{ old('quantity', $product->quantity) }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" id="price" name="price"
                                    value="{{ old('discount_price', $product->price) }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="discount_price">Discount Price</label>
                                <input type="text" id="discount_price" name="discount_price"
                                    value="{{ old('discount_price', $product->discount_price) }}" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="imagepath">Image input</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" name="imagepath[]" multiple
                                            id="imagepath">
                                        <label class="custom-file-label" for="imagepath">Choose Image</label>

                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>

                                </div>
                                @if ($product && !empty($product->imagepath))
                                    @php
                                        $images = is_array($product->imagepath)
                                            ? $product->imagepath
                                            : json_decode($product->imagepath, true);
                                    @endphp
                                    @if (is_array($images) && count($images))
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($images as $image)
                                                <img alt="Product Image" class="img-thumbnail shadow"
                                                    src="{{ asset('storage/' . $image) }}"
                                                    style="border-radius: 10px; width: 80px; height: 80px; object-fit: cover; margin-top: 8px">
                                            @endforeach
                                        </div>
                                    @endif
                                @endif


                            </div>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href=""{{ route('backend.Product.index') }} class="btn btn-secondary">Back</a>
                    <input type="submit" value="Update Product" class="btn btn-success float-right">
                </div>
            </div>
        </form>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const sizeContainer = document.getElementById('size-container');

                // Function to add new input field for size
                const addSizeField = () => {
                    const newField = document.createElement('div');
                    newField.classList.add('input-group', 'mb-2');

                    newField.innerHTML = `
                        <input type="text" name="size[]" class="form-control" placeholder="Enter size">
                        <button type="button" class="btn btn-danger remove-size">-</button>
                    `;

                    sizeContainer.appendChild(newField);
                };

                // Add new size field on "+" button click
                document.querySelector('.add-size').addEventListener('click', function() {
                    addSizeField();
                });

                // Remove size field on "-" button click
                sizeContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('remove-size')) {
                        event.target.parentElement.remove();
                    }
                });
            });
        </script>

    </section>
@endsection
