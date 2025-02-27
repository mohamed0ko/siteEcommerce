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
                                <th>Image</th>
                                <th></th>
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
                                            <!-- Add a separator if it's not the last color -->
                                            ,
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


                                <td>
                                    @php
                                        $images = json_decode($product->imagepath);
                                    @endphp
                                    @if (is_array($images) && count($images))
                                        @foreach ($images as $image)
                                            <img alt="Avatar" class="table-avatar" src="{{ asset('storage/' . $image) }}"
                                                style="border-radius: 50%; display: inline; width: 3rem;">
                                        @endforeach
                                    @endif
                                </td>
                                <td class="project-actions
                                text-right">
                                    <form action="{{ route('backend.Product.destroy', $product->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this Product ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm" type="submit"> <i class="fas fa-trash">
                                            </i>Delete</button>
                                    </form>
                                    <a class="btn btn-info btn-sm"
                                        href="{{ route('backend.Product.edit', $product->id) }}">
                                        <i class="fas fa-pencil-alt">
                                        </i>
                                        Edit
                                    </a>


                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>

        </div>
    @endsection
