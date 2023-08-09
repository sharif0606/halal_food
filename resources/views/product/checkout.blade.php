@extends('master')

@section('content')
<div class="col" style="padding: 0">
    <div class="form p-4">
        <div class="bg-white rounded shadow p-3">
            <p class="text-center bg-warning p-2 text-white"><b>Chackout Details</b></p>
            <hr />
            <div class="m-auto my-3 ms-5">
                <form action="{{ route('customer.placeorder') }}" method='post'>
                    @csrf
                    <div class="row">
                        <div class="col-7 w-50 mt-1">
                            <h3>Shipping Details</h3>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                >Full Name</label
                                >
                                <input
                                type="text"
                                class="form-control @error('full_name') is-invalid @enderror"
                                id="exampleInputEmail1"
                                name="full_name" value="{{ old('full_name') }}" placeholder="Enter Your Full Name"
                                aria-describedby="emailHelp"
                                />
                                @if($errors->has('full_name'))
                                    <small class="d-block text-danger">
                                        {{$errors->first('full_name')}}
                                    </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                >Mobile Number</label
                                >
                                <input
                                type="number"
                                class="form-control @error('contact') is-invalid @enderror"
                                id="exampleInputEmail1"
                                name="contact" value="{{ old('contact') }}" placeholder="Enter Your Phone Number"
                                aria-describedby="emailHelp"
                                />
                                @if($errors->has('contact'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('contact') }}
                                </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                    >Email address</label
                                >

                                <input
                                    type="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    id="exampleInputEmail1"
                                    name="email" value="{{ old('email') }}" placeholder="Enter Your Email"
                                    aria-describedby="emailHelp"
                                />
                                @if($errors->has('email'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('email') }}
                                </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                >District</label
                                >
                                <select id="district_id" name="district_id" class="form-select js-example-basic-single @error('district_id') is-invalid @enderror">
                                    <option value="">Select a district</option>
                                    @foreach ($districts as $district)
                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('shipping_address'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('shipping_address') }}
                                </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                >Upazila</label
                                >
                                <select id="upazila_id" name="upazila_id" class="form-select js-example-basic-single">
                                    <option value="">Select a Upazila</option>
                                </select>
                                @if($errors->has('shipping_address'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('shipping_address') }}
                                </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label"
                                >Shipping Address</label
                                >
                                <input
                                type="text"
                                class="form-control @error('shipping_address') is-invalid @enderror"
                                id="exampleInputEmail1"
                                name="shipping_address" value="{{ old('shipping_address') }}" placeholder="Enter Your Place"
                                aria-describedby="emailHelp"
                                />
                                @if($errors->has('shipping_address'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('shipping_address') }}
                                </small>
                                @endif
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label"
                                    >Order Note</label
                                >
                                <textarea class="form-control @error('order_note') is-invalid @enderror"
                                id="exampleInputEmail1" name="order_note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                                @if($errors->has('order_note'))
                                <small class="d-block text-danger">
                                    {{ $errors->first('order_note') }}
                                </small>
                                @endif
                            </div>
                        </div>
                        <div class="col-5 ms-3">
                            <div class="order-area">
                                <table class="table">
                                    <thead>
                                    <tr colspan="2">
                                        <th scope="col"><h3>Your Order</h3></th>
                                    </tr>
                                        @foreach ($carts as $item)
                                        <tr>
                                            <td>{{ $item->name }} X {{ $item->qty }} </td>
                                            <td> {{ $item->price*$item->qty }} TK</td>
                                        </tr>
                                        @endforeach
                                    </thead>
                                    <tbody class="shippingdata">

                                        @if (Session::has('coupon'))
                                        <tr>
                                            <td>Subtotal</td>
                                            <td> {{ $total_price }} BDT</td>
                                        </tr>
                                        <tr>
                                            <td>Discount</td>
                                            <td> (-) {{ Session::get('coupon')['discount'] }} TK</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td> {{ Session::get('coupon')['balance'] }} TK<del class="text-danger"> ৳{{ Session::get('coupon')['cart_total'] }} TK</del></td>
                                        </tr>
                                        @else
                                        <tr>
                                            <td>Subtotal</td>
                                            <td> {{ $total_price }} BDT</td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td> {{ $total_price }} BDT</td>
                                        </tr>
                                        @endif
                                        {{-- <tr>
                                            <td>
                                                <input id="bank" type="checkbox">
                                                <label for="bank">Direct Bank Transfer</label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <input id="card" type="checkbox">
                                                <label for="card">Credit Card</label>
                                            </td>
                                        </tr> --}}
                                        <tr>
                                            <td>
                                                <input id="delivery" name="payment_method" value="Cash" type="checkbox">
                                                <label for="delivery">Cash on Delivery</label>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                    </tfoot>
                                </table>
                                <button type="submit" class="submit shadow">place Order</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // District wise Upazilla Change
    $(document).ready(function() {
        $('#district_id').on('change', function() {
            var district_id = $(this).val();
            // console.log();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/upzilla/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        // console.log(data)
                        var d = $('#upazila_id').empty();
                        $.each(data, function(key, value) {
                            $('#upazila_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    },
                });
            }
        });
    });
</script>
<script>
    // District wise shipping Charge
    $(document).ready(function() {
        $('#district_id').on('change', function() {
            var district_id = $(this).val();
            // console.log();
            if (district_id) {
                $.ajax({
                    url: "{{ url('/shipping/ajax') }}/" + district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                       //console.log(data);
                        var shippingCharge = data;
                        //console.log(shippingCharge);
                        $('.shippingdata').html(shippingCharge);
                    },
                });
            }
        });
    });
</script>
@endsection
