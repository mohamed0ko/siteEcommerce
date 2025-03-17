@extends('backend.Layout.master')
@section('contentAdmin')
    <div class="invoice p-3 mb-3">
        <!-- title row -->
        <div class="row">
            <div class="row">
                <div class="col-12 table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Qty</th>
                                <th>Product Name</th>
                                <th>Description</th>
                                <th>Categoty</th>
                                <th>Color</th>
                                <th>Price</th>
                                <th>Dicount Price</th>
                                <th>Size</th>
                                <th>Status</th>


                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>
                                    @foreach ($product->colors as $color)
                                        {{ $color->name }}
                                        @if (!$loop->last)
                                        @endif
                                    @endforeach
                                </td>
                                <td>${{ $product->price }}</td>
                                <td>${{ $product->discount_price }}</td>
                                <td>
                                    @php
                                        // Decode the JSON if it's a valid string
                                        $sizes = is_string($product->size) ? json_decode($product->size, true) : [];
                                    @endphp

                                    @if (count($sizes) > 0)
                                        @foreach ($sizes as $size)
                                            <span>{{ $size }},</span>
                                        @endforeach
                                    @else
                                        <span>No sizes available</span>
                                    @endif
                                </td>

                                <td> <span class="badge badge-{{ $product->status ? 'success' : 'danger' }}">
                                        {{ $product->status ? 'Enable' : 'Disable' }}</span></td>

                            </tr>
                            <tr>

                                <td>
                                    @if ($product && !empty($product->imagepath))
                                        @php
                                            $images = is_array($product->imagepath)
                                                ? $product->imagepath
                                                : json_decode($product->imagepath, true);
                                        @endphp
                                        @if (is_array($images) && count($images))
                                            <div class="d-flex">
                                                @foreach ($images as $image)
                                                    <img alt="Product Image" class="img-thumbnail shadow"
                                                        src="{{ asset('storage/' . $image) }}"
                                                        style="border-radius: 10px; width: 100px; height: 100px; object-fit: cover;">
                                                @endforeach
                                            </div>
                                        @endif
                                    @endif
                                </td>
                                </\tr>

                        </tbody>
                    </table>
                    <div class="project-actions
                    text-right" style="display:flex; float: right;">
                        <form action="{{ route('backend.Product.destroy', $product->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this Product ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit"> <i class="fas fa-trash">
                                </i>Delete</button>
                        </form>
                        &nbsp;
                        <a class="btn btn-info btn-sm" href="{{ route('backend.Product.edit', $product->id) }}">
                            <i class="fas fa-pencil-alt">
                            </i>
                            Edit
                        </a>


                    </div>
                </div>
                <!-- /.col -->
            </div>

        </div>
    @endsection
