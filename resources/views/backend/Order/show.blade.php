@extends('backend.Layout.master')
@section('contentAdmin')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i>
                                    {{ $order->firstname }},{{ $order->lastname }}{{ $order->email }}.
                                    <small class="float-right">Date:{{ $order->created_at }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">

                                <address>
                                    <strong>{{ $order->firstname }},{{ $order->lastname }}.</strong><br>
                                    <b>Order ID:</b> {{ $order->id }}<br>
                                    {{ $order->addrres }}, Suite {{ $order->apartment }}<br>
                                    {{ $order->country }}, {{ $order->postcode }}<br>
                                    Phone:{{ $order->phone }}<br>
                                    Email: {{ $order->email }}
                                </address>
                            </div>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Image</th>
                                            <th>Qty</th>
                                            <th>price</th>
                                            <th>Product</th>
                                            <th>Size</th>
                                            <th>Color</th>
                                            <th>note</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->orderDetails as $detail)
                                            <tr>
                                                <td> @php
                                                    $images = json_decode($detail->product->imagepath, true);
                                                    $firstImage =
                                                        is_array($images) && count($images) > 0 ? $images[0] : null;
                                                @endphp
                                                    <img width="70px " height="70px"
                                                        src="{{ asset('storage/' . str_replace('\\', '/', $firstImage)) }}"
                                                        alt="">
                                                </td>
                                                <td>{{ $detail->quantityCart }}</td>
                                                <td>{{ $detail->price }}</td>
                                                <td>{{ $detail->name }}</td>
                                                <td>{{ $detail->size ?? 'N/A' }}</td>
                                                <td>
                                                    @if ($detail->color)
                                                        {{ $detail->product->colors->find($detail->color)->name }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $order->note ?? 'N/A' }}</td>



                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">

                            <div class="col-6">


                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>$250.30</td>
                                        </tr>
                                        <tr>
                                            <th>Tax (9.3%)</th>
                                            <td>$10.34</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>$5.80</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>${{ $total }}
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i
                                        class="fas fa-print"></i> Print</a>
                                <button type="button" class="btn btn-success float-right"><i
                                        class="far fa-credit-card"></i> Submit
                                    Payment
                                </button>
                                <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Generate PDF
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
