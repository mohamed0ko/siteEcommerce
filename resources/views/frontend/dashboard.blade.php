@extends('frontend.Layouts.master')
@section('content')
    @php
        use Illuminate\Support\Facades\Request;
        $colorId = Request::input('color') ?? [];
        $categoryId = Request::input('catergory') ?? [];
        $sizeId = Request::input('catergory') ?? [];
    @endphp
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container-fluid">
            @foreach ($sliders as $slider)
                <div class="row">
                    <div class="col-lg-6 p-0">
                        <div class="categories__item categories__large__item set-bg"
                            data-setbg="{{ 'storage/' . $slider->image1 }}">
                            <div class="categories__text">
                                <h1>{{ $slider->title1 }}</h1>

                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                <div class="categories__item set-bg" data-setbg="{{ 'storage/' . $slider->image2 }}">
                                    <div class="categories__text">
                                        <h4>{{ $slider->title2 }}</h4>

                                        <a href="#">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                <div class="categories__item set-bg" data-setbg="{{ 'storage/' . $slider->image3 }}">
                                    <div class="categories__text">
                                        <h4>{{ $slider->title3 }}</h4>

                                        <a href="#">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                <div class="categories__item set-bg" data-setbg="{{ 'storage/' . $slider->image4 }}">
                                    <div class="categories__text">
                                        <h4>{{ $slider->title4 }}</h4>

                                        <a href="#">Shop now</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 p-0">
                                <div class="categories__item set-bg" data-setbg="{{ 'storage/' . $slider->image5 }}">
                                    <div class="categories__text">
                                        <h4>{{ $slider->title5 }}</h4>

                                        <a href="#">Shop now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="section-title">
                        <h4>New product</h4>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8">
                    <ul class="filter__controls">
                        <li class="active" data-filter="*">All</li>
                        @foreach ($categories as $category)
                            <li data-filter=".{{ Str::slug($category->name) }}">{{ $category->name }}</li>
                        @endforeach

                    </ul>
                </div>
            </div>
            <div class="row property__gallery">
                @foreach ($Newproduct as $new)
                    @php
                        $images = is_array($new->imagepath) ? $new->imagepath : json_decode($new->imagepath, true);
                        $firstImage = $images[0] ?? null;

                    @endphp
                    <div class="col-lg-3 col-md-4 col-sm-6 mix {{ Str::slug($new->category->name) }} ">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="{{ asset('storage/' . $firstImage) }}">
                                @if ($new->discount_price)
                                    <div class="label sale">Sale</div>
                                @endif
                                @if ($new->quantity == 0)
                                    <div class="label stockout">
                                        out of stock
                                    </div>
                                @endif
                                @if ($new->created_at->toDateString() == now()->toDateString())
                                    <div class="label new">
                                        New
                                    </div>
                                @endif
                                @if ($firstImage)
                                    <ul class="product__hover">
                                        <li><a href="{{ asset('storage/' . $firstImage) }}" class="image-popup"><span
                                                    class="arrow_expand"></span></a></li>
                                        <li>
                                            <form id="favorite-form-{{ $new->id }}"
                                                action="{{ route('favorite.toggle', $new->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                            </form>

                                            <a href="#"
                                                onclick="event.preventDefault(); document.getElementById('favorite-form-{{ $new->id }}').submit();">
                                                <span class="icon_heart_alt"
                                                    @if (Auth::check() && Auth::user()->favorites->contains($new->id)) style="color: red;" @endif>
                                                </span>
                                            </a>
                                        </li>


                                        <li><a href="#"><span class="icon_bag_alt"></span></a></li>
                                    </ul>
                                @endif
                            </div>
                            <div class="product__item__text">
                                <h6><a href="{{ route('frontend.ProductDetails', $new->id) }}">{{ $new->name }}</a>
                                </h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                                <div class="product__price">
                                    @if ($new->discount_price)
                                        $ {{ $new->discount_price }}
                                        <span>$
                                            {{ $new->price }}</span>
                                    @else
                                        $
                                        {{ $new->price }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Begin -->
    <section class="banner set-bg" data-setbg="img/banner/banner-1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-8 m-auto">
                    <div class="banner__slider owl-carousel">
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                        <div class="banner__item">
                            <div class="banner__text">
                                <span>The Chloe Collection</span>
                                <h1>The Project Jacket</h1>
                                <a href="#">Shop now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Trend Section Begin -->
    <section class="trend spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Hot Trend</h4>
                        </div>
                        @foreach ($hotTrends as $trand)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    @php
                                        $images = is_array($trand->imagepath)
                                            ? $trand->imagepath
                                            : json_decode($trand->imagepath, true);
                                        $firstImage = $images[0] ?? null;

                                    @endphp
                                    <img src="{{ asset('storage/' . $firstImage) }}" width="90px" height="90px"
                                        alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>{{ $trand->name }}</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">
                                        @if ($trand->discount_price and $trand->price)
                                            ${{ $trand->discount_price }}
                                            <span>${{ $trand->price }}</span>
                                        @else
                                            $ {{ $trand->price }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Best seller</h4>
                        </div>
                        @foreach ($BestSeller as $best)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    @php
                                        $images = is_array($best->imagepath)
                                            ? $best->imagepath
                                            : json_decode($best->imagepath, true);
                                        $firstImage = $images[0] ?? null;

                                    @endphp
                                    <img src="{{ asset('storage/' . $firstImage) }}" width="90px" height="90px"
                                        alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>{{ $best->name }}</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">
                                        @if ($best->discount_price and $best->price)
                                            ${{ $best->discount_price }}
                                            <span>${{ $best->price }}</span>
                                        @else
                                            $ {{ $best->price }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="trend__content">
                        <div class="section-title">
                            <h4>Feature</h4>
                        </div>
                        @foreach ($featureds as $featured)
                            <div class="trend__item">
                                <div class="trend__item__pic">
                                    @php
                                        $images = is_array($featured->imagepath)
                                            ? $featured->imagepath
                                            : json_decode($featured->imagepath, true);
                                        $firstImage = $images[0] ?? null;

                                    @endphp
                                    <img src="{{ asset('storage/' . $firstImage) }}" width="90px" height="90px"
                                        alt="">
                                </div>
                                <div class="trend__item__text">
                                    <h6>{{ $featured->name }}</h6>
                                    <div class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <div class="product__price">${{ $featured->price }}</div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Trend Section End -->

    <!-- Discount Section Begin -->
    <section class="discount">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 p-0">
                    <div class="discount__pic">
                        <img src="img/discount.jpg" alt="">
                    </div>
                </div>
                <div class="col-lg-6 p-0">
                    <div class="discount__text">
                        <div class="discount__text__title">
                            <span>Discount</span>
                            <h2>Summer 2019</h2>
                            <h5><span>Sale</span> 50%</h5>
                        </div>
                        <div class="discount__countdown" id="countdown-time">
                            <div class="countdown__item">
                                <span>22</span>
                                <p>Days</p>
                            </div>
                            <div class="countdown__item">
                                <span>18</span>
                                <p>Hour</p>
                            </div>
                            <div class="countdown__item">
                                <span>46</span>
                                <p>Min</p>
                            </div>
                            <div class="countdown__item">
                                <span>05</span>
                                <p>Sec</p>
                            </div>
                        </div>
                        <a href="#">Shop now</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Discount Section End -->

    <!-- Services Section Begin -->
    <section class="services spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-car"></i>
                        <h6>Free Shipping</h6>
                        <p>For all oder over $99</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-money"></i>
                        <h6>Money Back Guarantee</h6>
                        <p>If good have Problems</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-support"></i>
                        <h6>Online Support 24/7</h6>
                        <p>Dedicated support</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="services__item">
                        <i class="fa fa-headphones"></i>
                        <h6>Payment Secure</h6>
                        <p>100% secure payment</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

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
