@extends('frontend.Layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping favorite</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-favorite spad">
        <div class="container">

            <div class="row">
                <div class="col-lg-12">
                    <div class="shop__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($favorites as $favorite)
                                    <tr>
                                        <td class="cart__product__item">
                                            @php
                                                $images = json_decode($favorite->imagepath, true);
                                                $firstImage =
                                                    is_array($images) && count($images) > 0 ? $images[0] : null;
                                            @endphp
                                            <img width="90px" height="90px"
                                                src="{{ asset('storage/' . str_replace('\\', '/', $firstImage)) }}"
                                                alt="">
                                            <div class="cart__product__item__title">
                                                <h6><a style="color: #111111;"
                                                        href="/product-details/{{ $favorite->id }}">{{ $favorite->name }}</a>
                                                </h6>
                                            </div>
                                        </td>
                                        <td class="cart__price">$ {{ number_format($favorite->price, 2, '.') }}</td>



                                        <td class="cart__close">
                                            <form action="{{ route('favorites.destroy', $favorite->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="icon_close"></button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="cart__btn">
                        <a href="{{ route('frontend.Shop') }}">Continue Shopping</a>
                    </div>
                </div>


            </div>


        </div>
    </section>
    <!-- Shop Cart Section End -->
@endsection
