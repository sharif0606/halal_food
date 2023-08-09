@extends('master')

@section('content')

<div class="col right-side" style="padding: 0">
    <div class="cart p-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Cart</li>
        </ol>
      </nav>
      <div class="cart-condition shadow">
        @php
        $first_number = 10000.00;
        $second_number = str_replace(",", "", $total_price);
        $sum_total = is_numeric($second_number) ? $first_number - $second_number : 0;
        $progressbar=(100/$first_number)*$second_number;
        @endphp

    @if ($second_number > $first_number)
        <p>Free shipping available!</p>
    @else
    <p>Add <span>{{ number_format($sum_total, 2) }} TK</span> to your cart and get free shipping!</p>

    @endif


        {{--  <p>You Add <span>{{ $total_price }} TK</span> in cart !</p>  --}}
        <div class="progress mb-3">
          <div
            class="progress-bar bg-warning"
            role="progressbar"
            aria-label="Basic example"
            style="width: {{ $progressbar }}%"
            aria-valuenow="25"
            aria-valuemin="0"
            aria-valuemax="100"
          ></div>
        </div>
      </div>
      <div class="prorduct-table">
        <div class="row">
          <div class="col-sm-8 p-3">
            <div class="rounded bg-white my-3 shadow p-2">
              <table class="table">
                <thead>
                  <tr>

                   {{--  @php print_r(Session::get('shipp'))@endphp  --}}
                    <th scope="col">Image</th>
                    <th scope="col">Product</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Subtotal</th>
                    <th class="col">Remove</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse ($carts as $cartitem)
                    <tr>
                        <td>
                          <img class="img-fluid" src="{{ asset('./../pos/') }}/{{ $cartitem->options->product_image }}" alt=""/>
                        </td>
                        <td>{{ $cartitem->name }}</td>
                        <td>{{ $cartitem->price }} TK</td>
                        <td>
                            <strong class="ps-2">{{ $cartitem->qty }}</strong>
                        </td>
                        <td>{{ $cartitem->price*$cartitem->qty  }} TK</td>
                        <td>
                            <a href="{{ route('removefrom.cart',['cart_id' => $cartitem->rowId]) }}">
                                <i class="ms-3 text-danger bi bi-x-circle-fill"></i>
                            </a>
                        </td>
                      </tr>
                    @empty

                    @endforelse

                </tbody>
              </table>
            </div>
            <div class="rounded bg-white my-3 shadow p-3">
                @if(Session::has('response'))
                {!!Session::get('response')['message']!!}
                @endif
                <form action="{{ route('customer.couponapply') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-7">
                            <input type="text" name="cupon_code" placeholder="Cupon Code" class="form-control">
                        </div>
                        <div class="col-sm-5">
                            <button type="submit" class="btn btn-warning">Apply Coupon</button>

                        </div>
                    </div>
                </form>
              <div class="input-group mb-3 mt-3">
                <a class="btn btn-warning" href="{{ route('product.index') }}">Continue Shopping</a>
              </div>
            </div>
          </div>
          <div class="col-sm-4 p-3">
            <div class="rounded bg-white my-3 shadow">
              <div class="cart-detaits p-3">
                <p>CART TOTALS</p>
                <hr />
                @if(Session::has('coupon'))
                <div class="row">
                    <b>Total Price :<span class="m-5">{{ $total_price }} TK</span></b>
                </div>
                <div class="row">
                    <b>Discount :<span class="m-5">{{ Session::get('coupon')['discount'] }} TK</span></b>
                </div>
                <div class="row">
                    <b>Grant Total :<span class="ms-5">{{ Session::get('coupon')['balance'] }} TK</span> <del class="text-danger">{{ Session::get('coupon')['cart_total'] }} TK</del></b>
                </div>
                @else
                <div class="row">
                    <b>Total Price :<span class="m-5">{{ $total_price }} TK</span></b>
                </div>
                <div class="row">
                    <b>Discount : <span class="m-5"> 0.00 TK</span></b>
                </div>
                <div class="row">
                    <b>Grant Total :<span class="m-5">{{ $total_price }} TK</span></b>
                </div>
                @endif
                <hr />
                <a class="submit shadow" href="{{ route('customer.checkoutpage') }}">Process to Chackout</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
    let addBtn= document.querySelector('#add');
    let subBtn= document.querySelector('#sub');
    let qty= document.querySelector('#qtyBox');
    // console.log(addBtn,subBtn,qty);
    addBtn.addEventListener('click',()=>{
        qty.value=parseInt(qty.value)+1;
    });
    subBtn.addEventListener('click',()=>{
        if(qty.value <= 0){
            qty.value=0;
        }else{
            qty.value=parseInt(qty.value) -1;
        }
    });
</script>

@endsection
