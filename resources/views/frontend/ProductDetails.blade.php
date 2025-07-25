@extends('frontend.Layouts.master')
@section('content')

    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <a href="#">{{ $product->category->name }} </a>
                        <span>{{ $product->name }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__left product__thumb nice-scroll">
                            @php
                                // Check if $product->imagepath is an array or a JSON string
                                $images = is_array($product->imagepath)
                                    ? $product->imagepath
                                    : json_decode($product->imagepath, true);
                                $firstFourImages = is_array($images) ? array_slice($images, 0, 3) : []; // Get the first 4 images
                            @endphp

                            @foreach ($firstFourImages as $index => $image)
                                <a class="pt {{ $loop->first ? 'active' : '' }}" href="#product-{{ $index + 1 }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Thumbnail" class="lazyload">
                                </a>
                            @endforeach
                        </div>
                        <div class="content">
                            @php
                                // Check if $product->imagepath is an array or a JSON string
                                $images = is_array($product->imagepath)
                                    ? $product->imagepath
                                    : json_decode($product->imagepath, true);
                                $firstFourImages = is_array($images) ? array_slice($images, 0, 1) : []; // Get the first 4 images
                            @endphp

                            @foreach ($firstFourImages as $index => $image)
                                <a class="pt {{ $loop->first ? 'active' : '' }}" href="#product-{{ $index + 1 }}">
                                    <img src="{{ asset('storage/' . $image) }}" alt="Product Thumbnail">
                                </a>
                            @endforeach
                        </div>

                    </div>
                </div>

                <div class="col-lg-6">
                    <form action="{{ route('frontend.addToCart', $product->id) }}" method="post">
                        @csrf
                        <div class="product__details__text">
                            <h3>{{ $product->name }} <span>Brand: {{ $product->brand->name }}</span> </h3>
                            {{--    <div class="rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <span>( 138 reviews )</span>
                            </div> --}}
                            <div class="product__details__price">
                                @if ($product->discount_price)
                                    $ {{ $product->discount_price }}
                                    <span>$
                                        {{ $product->price }}</span>
                                @else
                                    $
                                    {{ $product->price }}
                                @endif
                            </div>


                            <p>{{ $product->short_description }}</p>
                            <div class="product__details__button">

                                <div class="quantity">
                                    <span>Quantity:</span>
                                    <div class="pro-qty">
                                        <input name="quantityCart" type="text" value="1">
                                    </div>
                                </div>
                                <button type="submit" class="cart-btn" style="border: none; cursor: pointer;"
                                    {{ $product->quantity <= 0 ? 'disabled' : '' }}>
                                    <span class="icon_bag_alt"></span>
                                    {{ $product->quantity > 0 ? 'Add to Cart' : 'Out of Stock' }}
                                </button>
                                <ul>
                                    {{--  <li>
                                        <a href="#"
                                            onclick="event.preventDefault(); document.getElementById('favorite-form-{{ $product->id }}').submit();">
                                            <span class="icon_heart_alt"
                                                @if (Auth::check() && Auth::user()->favorites->contains($product->id)) style="color: red;" @endif>
                                            </span>
                                        </a>
                                    </li>

                                    <form id="favorite-form-{{ $product->id }}"
                                        action="{{ route('favorite.toggle', $product->id) }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form> --}}

                                </ul>


                            </div>
                            <div class="product__details__widget">
                                <ul>
                                    <li>
                                        <span>Availability:</span>
                                        <div class="stock__checkbox">
                                            <label for="stockin">
                                                In Stock
                                                <input type="checkbox" id="stockin">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </li>

                                    <li>
                                        <span>Available color:</span>
                                        <div class="color__checkbox">
                                            @forelse ($product->colors as $color)
                                                <label for="color-{{ $color->id }}">
                                                    <input type="radio" name="color" id="color-{{ $color->id }}"
                                                        value="{{ $color->id }}">
                                                    <span class="checkmark"
                                                        style="background-color: {{ $color->code }};"></span>
                                                </label>
                                            @empty
                                                <p>No color available</p>
                                            @endforelse
                                        </div>
                                    </li>

                                    <li>
                                        <span>Available size:</span>
                                        <div class="size__btn">
                                            @php
                                                // Ensure $product->size is properly formatted before decoding
                                                $sizes = is_string($product->size)
                                                    ? json_decode($product->size, true)
                                                    : $product->size;

                                                // Ensure it's an array after decoding
                                                $sizes = is_array($sizes) ? $sizes : [];

                                                // Remove any null values from the array
                                                $sizes = array_filter($sizes, function ($size) {
                                                    return !is_null($size);
                                                });

                                                // Re-index the array after filtering out null values
                                                $sizes = array_values($sizes);
                                            @endphp

                                            @if (!empty($sizes))
                                                @foreach ($sizes as $index => $size)
                                                    <label for="size-{{ $index }}" class="size-label">
                                                        <input type="radio" id="size-{{ $index }}" name="size"
                                                            value="{{ $size }}">
                                                        {{ $size }}
                                                    </label>
                                                @endforeach
                                            @else
                                                <p>No size available</p>
                                            @endif
                                        </div>
                                    </li>


                                    <li>
                                        <span>Promotions:</span>
                                        <p>
                                            @if (is_numeric($product->shipping))
                                                ${{ number_format($product->shipping, 2) }}
                                            @else
                                                Free Chipping
                                            @endif
                                        </p>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Description</a>
                            </li>
                            {{--   <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Specification</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Reviews ( 2 )</a>
                            </li> --}}
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <h6>Description</h6>
                                <p>{{ $product->description }}</p>

                            </div>
                            {{--  <div class="tab-pane" id="tabs-2" role="tabpanel">
                                <h6>Specification</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <h6>Reviews ( 2 )</h6>
                                <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed
                                    quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt loret.
                                    Neque porro lorem quisquam est, qui dolorem ipsum quia dolor si. Nemo enim ipsam
                                    voluptatem quia voluptas sit aspernatur aut odit aut loret fugit, sed quia ipsu
                                    consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nulla
                                    consequat massa quis enim.</p>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium
                                    quis, sem.</p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="related__title">
                        <h5>RELATED PRODUCTS</h5>
                    </div>
                </div>
                @foreach ($product->category->Product as $item)
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <div class="product__item">
                            @php
                                $images = is_array($item->imagepath)
                                    ? $item->imagepath
                                    : json_decode($item->imagepath, true);
                                $firstImage = !empty($images) ? $images[0] : null;

                            @endphp

                            @if ($firstImage)
                                <div class="product__item__pic set-bg" style="background-image: url('');">
                                    <img src="{{ asset('storage/' . $firstImage) }}" alt="">
                                    @if ($item->discount_price)
                                        <div class="label sale" style="padding: 4px 8px;">Sale</div>
                                    @endif
                                    @if ($item->quantity == 0)
                                        <div class="label stockout">
                                            out of stock
                                        </div>
                                    @endif
                                    @if ($item->created_at->toDateString() == now()->toDateString())
                                        <div class="label new">
                                            New
                                        </div>
                                    @endif
                                    <ul class="product__hover">
                                        <li><a href="{{ asset('storage/' . $firstImage) }}" class="image-popup"><span
                                                    class="arrow_expand"></span></a></li>
                                        <li><a href="#"><span class="icon_heart_alt"></span></a></li>
                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                </div>
                            @else
                                <p>No image available</p>
                            @endif

                            <div class="product__item__text">
                                <h6><a href="{{ route('frontend.ProductDetails', $item->id) }}">{{ $item->name }}</a>
                                </h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">
                                    @if ($item->discount_price and $item->price)
                                        ${{ $product->discount_price }}
                                        <span>${{ $item->price }}</span>
                                    @else
                                        $ {{ $item->price }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sizeLabels = document.querySelectorAll(".size-label");

            sizeLabels.forEach(label => {
                label.addEventListener("click", function() {
                    // Remove "active" class from all labels
                    sizeLabels.forEach(l => l.classList.remove("active"));

                    // Add "active" class to the clicked label
                    this.classList.add("active");
                });
            });
        });
    </script>


    <!-- Product Details Section End -->
@endsection
