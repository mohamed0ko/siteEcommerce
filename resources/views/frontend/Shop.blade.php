@extends('frontend.Layouts.master')
@section('content')
    @php
        use Illuminate\Support\Facades\Request;
        $colorId = Request::input('color') ?? [];
        $categoryId = Request::input('catergory') ?? [];
        $sizeId = Request::input('catergory') ?? [];
    @endphp
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/Home"><i class="fa fa-home"></i> Home</a>
                        <span>Shop</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Section Begin -->
    <section class="shop spad">
        <form method="GET">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="shop__sidebar">
                            <div class="sidebar__categories">
                                <div class="section-title">
                                    <h4>Categories</h4>
                                </div>
                                <div class="categories__accordion">
                                    <div class="accordion" id="accordionExample">
                                        @foreach ($categories as $category)
                                            <div class="card-body">
                                                <ul>
                                                    <li> <a href="/shop/{{ $category->id }}">{{ $category->name }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach


                                    </div>
                                </div>
                            </div>
                            <div class="sidebar__filter">
                                <div class="section-title">
                                    <h4>Shop by price</h4>
                                </div>
                                <div class="filter-range-wrap">

                                    <div class="range-slider">
                                        <div class="price-input">
                                            <p>Min:</p>
                                            <input min="0" max="{{ $priceOptions->maxPrice }}" type="number"
                                                name="min" value="{{ request('min', 1) }}" id="min">

                                            <p>Max:</p>
                                            <input min="{{ $priceOptions->minPrice }}" max="{{ $priceOptions->maxPrice }}"
                                                type="number" name="max" value="{{ request('max') }}" id="max">


                                        </div>

                                    </div>
                                </div>

                            </div>
                            {{-- <div class="sidebar__sizes">
                                <div class="section-title">
                                    <h4>Shop by size</h4>
                                </div>
                                <div class="size__list">
                                    @foreach ($sizes as $size)
                                        <label for="{{ $size }}">
                                            {{ $size }}
                                            <input type="checkbox" id="{{ $size }}" name="size[]"
                                                value="{{ $size }}">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach

                                </div>
                            </div> --}}
                            <div class="sidebar__color">
                                <div class="section-title">
                                    <h4>Shop by Color</h4>
                                </div>
                                <div class="size__list color__list">
                                    @foreach ($colors as $color)
                                        <label for=" {{ $color->name }}">
                                            {{ $color->name }}
                                            <input @checked(in_array($color->id, $colorId)) type="checkbox" id=" {{ $color->name }}"
                                                value="{{ $color->id }}" name="color[]">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach

                                </div>
                                <input type="submit" value="Filter" class="filter"></input>
                                <a class="rest" href="{{ route('frontend.Shop') }}">Rest</a>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-9 col-md-9">
                        <div class="row">
                            @foreach ($products as $product)
                                <div class="col-lg-4 col-md-6">
                                    <div class="product__item">
                                        @php
                                            // Properly decode the JSON string
                                            $imagepath = is_string($product->imagepath)
                                                ? json_decode(trim($product->imagepath, '"'), true)
                                                : [];
                                            $firstImage =
                                                count($imagepath) > 0 ? str_replace('\/', '/', $imagepath[0]) : null;
                                        @endphp

                                        @if ($firstImage)
                                            <div class="product__item__pic set-bg" {{-- data-setbg="{{ asset('storage/' . $firstImage) }}" --}}>
                                                <img src="{{ asset('storage/' . $firstImage) }}" alt="">
                                                @if ($product->discount_price)
                                                    <div class="label sale">Sale</div>
                                                @endif
                                                @if ($product->quantity == 0)
                                                    <div class="label stockout">
                                                        out of stock
                                                    </div>
                                                @endif
                                                @if ($product->created_at->toDateString() == now()->toDateString())
                                                    <div class="label new">
                                                        New
                                                    </div>
                                                @endif
                                                <ul class="product__hover ">
                                                    <li><a href="{{ asset('storage/' . $firstImage) }}"
                                                            class="image-popup"><span class="arrow_expand"></span></a></li>
                                                    <li>
                                                        <a href="#"
                                                            onclick="event.preventDefault(); document.getElementById('favorite-form-{{ $product->id }}').submit();">
                                                            <span class="icon_heart_alt"
                                                                @if (Auth::check() && Auth::user()->favorites->contains($product->id)) style="color: red;" @endif>
                                                            </span>
                                                        </a>
                                                    </li>

                                                    <form id="favorite-form-{{ $product->id }}"
                                                        action="{{ route('favorite.toggle', $product->id) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                    </form>


                                                    <li>
                                                        <a href="{{ route('frontend.addToCart', $product->id) }}">
                                                            <span class="icon_bag_alt"></span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif


                                        <div class="product__item__text">
                                            <h6>
                                                <a
                                                    href="{{ route('frontend.ProductDetails', $product->id) }}">{{ $product->name }}</a>
                                            </h6>
                                            <div class="rating">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="product__price">
                                                @if ($product->discount_price and $product->price)
                                                    ${{ $product->discount_price }}
                                                    <span>${{ $product->price }}</span>
                                                @else
                                                    $ {{ $product->price }}
                                                @endif

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="col-lg-12 text-center">
                                <div class="pagination__option">
                                    <a href="#">1</a>
                                    <a href="#">2</a>
                                    <a href="#">3</a>
                                    <a href="#"><i class="fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>

    </section>
    <!-- Shop Section End -->

    <!-- Instagram Begin -->
    <div class="instagram">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-1.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-2.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-3.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-4.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-5.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-4 col-sm-4 p-0">
                    <div class="instagram__item set-bg" data-setbg="img/instagram/insta-6.jpg">
                        <div class="instagram__text">
                            <i class="fa fa-instagram"></i>
                            <a href="#">@ ashion_shop</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Instagram End -->
@endsection
