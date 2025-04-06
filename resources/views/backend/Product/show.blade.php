@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">
        <div class="container-fluid">
            <div class="row">



                <div class="card card-primary card-outline" style="width: 25%">
                    <div class="card-body box-profile">
                        @php
                            $images = json_decode($product->imagepath, true); // Decode JSON to array
                            $firstImage = is_array($images) && count($images) ? $images[0] : null;
                        @endphp

                        @if ($firstImage)
                            <div class="d-flex">
                                <img alt="Product Image" class="img-thumbnail shadow profile-user-img img-fluid"
                                    src="{{ asset('storage/' . $firstImage) }}"
                                    style="border-radius: 10px; width: 80px; height: 80px; object-fit: cover;">
                            </div>
                        @endif



                        <h3 class="profile-username text-center">{{ $product->name }}</h3>

                        <p class="text-muted text-center">{{ $product->short_description }}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>price :</b> <a class="float-right">${{ $product->price }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>discount price :</b> <a class="float-right">${{ $product->discount_price }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Shipping :</b> <a class="float-right">
                                    @if (is_numeric($product->shipping))
                                        ${{ number_format($product->shipping, 2) }}
                                    @else
                                        {{ $product->shipping }}
                                    @endif
                                </a>
                            </li>
                            <li class="list-group-item">
                                <b>Trending :</b> <a class="float-right"><span
                                        class="badge badge-{{ $product->is_trending ? 'success' : 'danger' }}">
                                        {{ $product->is_trending ? 'is_trending' : 'no_trending' }}</span></a>
                            </li>

                            <li class="list-group-item">
                                <b>Color :</b> <a class="float-right">
                                    @foreach ($product->colors as $color)
                                        {{ $color->name }}
                                        @if (!$loop->last)
                                        @endif
                                    @endforeach
                                </a>
                            </li>
                            @php
                                // Decode the JSON if it's a valid string
                                $sizes = is_string($product->size) ? json_decode($product->size, true) : [];
                            @endphp


                            <li class="list-group-item">
                                <b>Size :</b> <a class="float-right">
                                    @if (count($sizes) > 0)
                                        @foreach ($sizes as $size)
                                            <span>{{ $size }},</span>
                                        @endforeach
                                    @else
                                        <span>No sizes available</span>
                                    @endif
                                </a>
                            </li>
                        </ul>
                        <div class="project-actions
                        text-right"
                            style="display:flex;>
                            <form action="{{ route('backend.Product.destroy', $product->id) }}"
                            method="POST" onsubmit="return confirm('Are you sure you want to delete this Product ?');">
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
                    <!-- /.card-body -->
                </div>
                <div class="card card-primary" style="width: 70%; margin-left: 27px">
                    <div class="card-header">
                        <h3 class="card-title">More Info</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Category</strong>

                        <p class="text-muted">
                            {{ $product->category->name }}
                        </p>

                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Brand</strong>

                        <p class="text-muted">
                            {{ $product->brand->name }}
                        </p>

                        <hr>
                        <strong><i class="fas fa-book mr-1"></i> Description</strong>

                        <p class="text-muted">
                            {{ $product->description }}
                        </p>

                        <hr>
                        @if ($product && !empty($product->imagepath))
                            @php
                                $images = is_array($product->imagepath)
                                    ? $product->imagepath
                                    : json_decode($product->imagepath, true);

                            @endphp
                            @if (is_array($images) && count($images))
                                <div class="">
                                    <strong><i class="fas fa-book mr-1"></i> Image </strong> <br><br>
                                    @foreach ($images as $image)
                                        <img alt="Product Image" class="img-thumbnail shadow profile-user-img img-fluid"
                                            src="{{ asset('storage/' . $image) }}"
                                            style="border-radius: 10px; width: 100px; height: 100px; object-fit: cover;">
                                    @endforeach
                                </div>
                            @endif
                        @endif



                    </div>
                    <!-- /.card-body -->
                </div>


            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

    {{--   <div class="row">
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

    </div> --}}
@endsection
