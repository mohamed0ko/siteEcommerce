@extends('backend.Layout.master')

@section('contentAdmin')
    <section class="content">

        <form action="{{ route('backend.Product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="description">Product Description</label>
                                <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="short_description">Short Description</label>
                                <textarea id="short_description" name="short_description" class="form-control" rows="4">{{ old('short_description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select id="category_id" name="category_id" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    @foreach ($categoties as $category)
                                        <option value="{{ old('category_id', $category->id) }}">{{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand_id">Brand</label>
                                <select id="brand_id" name="brand_id" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ old('brand_id', $brand->id) }}">{{ $brand->name }}
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
                                <label for="status">Trending</label>
                                <select id="is_trending" name="is_trending" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option value="1"
                                        {{ old('is_trending', $product->is_trending ?? '') == 1 ? 'selected' : '' }}>
                                        is_trending</option>
                                    <option value="0"
                                        {{ old('is_trending', $product->is_trending ?? '') == 0 ? 'selected' : '' }}>
                                        no_trending</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="status">Feature</label>
                                <select id="is_trending" name="is_trending" class="form-control custom-select">
                                    <option selected disabled>Select one</option>
                                    <option value="1"
                                        {{ old('is_featured', $product->is_featured ?? '') == 1 ? 'selected' : '' }}>
                                        is_featured</option>
                                    <option value="0"
                                        {{ old('is_featured', $product->is_featured ?? '') == 0 ? 'selected' : '' }}>
                                        no_featured</option>
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
                                    <div class="input-group mb-2">
                                        <input type="text" name="size[]" class="form-control" placeholder="Enter size">
                                        <button type="button" class="btn btn-success add-size">+</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label>
                                <input type="text" id="price" name="price" value="{{ old('price') }}"
                                    class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="discount_price">Discount Price</label>
                                <input type="text" id="discount_price" name="discount_price"
                                    value="{{ old('discount_price') }}" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="shipping"> Shipping</label>
                                <input type="text" id="shipping" name="shipping" value="{{ old('shipping') }}"
                                    class="form-control">
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
                    <input type="submit" value="Create new Porject" class="btn btn-success float-right">
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
                sizeContainer.addEventListener('click', function(event) {
                    if (event.target.classList.contains('add-size')) {
                        addSizeField();
                    }

                    // Remove size field on "-" button click
                    if (event.target.classList.contains('remove-size')) {
                        event.target.parentElement.remove();
                    }
                });
            });
        </script>

    </section>
@endsection
