@extends('frontend.Layouts.master')
@section('content')
    <!-- Breadcrumb Begin -->
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Shop Cart Section Begin -->
    <section class="shop-cart spad">
        <div class="container">
            <form action="{{ route('frontend.updateCartAll') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-12">
                        <div class="shop__cart__table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Details</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cartProduct as $cart)
                                        <tr>
                                            <td class="cart__product__item">
                                                @php
                                                    $images = json_decode($cart->product->imagepath, true);
                                                    $firstImage =
                                                        is_array($images) && count($images) > 0 ? $images[0] : null;
                                                @endphp
                                                <img width="90px" height="90px"
                                                    src="{{ asset('storage/' . str_replace('\\', '/', $firstImage)) }}"
                                                    alt="">
                                                <div class="cart__product__item__title">
                                                    <h6><a style="color: #111111;"
                                                            href="/product-details/{{ $cart->product->id }}">{{ $cart->name }}</a>
                                                    </h6>
                                                </div>
                                            </td>
                                            <td class="cart__price">$ {{ number_format($cart->price, 2, '.') }}</td>
                                            <td class="cart__price" style="color: #111111;">
                                                @if ($cart->size)
                                                    {{ $cart->size }}/
                                                @endif
                                                @if ($cart->color)
                                                    {{ $cart->product->colors->find($cart->color)->name }}
                                                @endif
                                            </td>
                                            <td class="cart__quantity">
                                                <div class="pro-qty">
                                                    <input type="text" name="quantities[{{ $cart->id }}]"
                                                        value="{{ $cart->quantityCart }}" min="1">
                                                </div>
                                            </td>
                                            <td class="cart__total">$
                                                {{ number_format($cart->price * $cart->quantityCart, 2, '.') }}</td>
                                            <td class="cart__close">
                                                <a href="{{ route('frontend.destroy', $cart->id) }}"><span
                                                        class="icon_close"></span></a>
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
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="cart__btn update__btn">
                            <button style="border: none;  cursor: pointer;" type="submit">
                                <span class="icon_loading"></span> Update
                                cart</button>
                        </div>
                    </div>

                </div>
            </form>
            <div class="row">
                <div class="col-lg-6">
                    <div class="discount__content">
                        <h6>Discount codes</h6>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">Apply</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4 offset-lg-2">
                    <div class="cart__total__procced">
                        <h6>Cart total</h6>
                        <ul>
                            <li>Subtotal <span>$ {{ number_format($subtotal, 2, '.') }}</span></li>
                            <li>Shipping <span>$ {{ number_format($shipping, 2, '.') }}</span></li>
                            <li>Total <span>${{ number_format($total, 2, '.') }}</span></li>
                        </ul>
                        <a href="{{ route('frontend.checkout') }}" class="primary-btn">Proceed to checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Cart Section End -->
@endsection
