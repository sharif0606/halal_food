@extends('customer_master')

@section('content')

<div class="col right-side" style="padding: 0">
    <div class="cart p-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-list"><a href="{{ route('home') }}">Home/</a></li>
          <li class="breadcrumb-item active" aria-current="page">Wish List</li>
        </ol>
      </nav>
      <div class="prorduct-table">
        <div class="row">
            <p class="text-center">Your All Wishlist Seen</p>
            <hr />
          <div class="col-sm-12 p-3">
            <div class="rounded bg-white my-3 shadow p-2">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"> #SL</th>
                    <th scope="col">Date</th>
                    <th scope="col">Image</th>
                    <th scope="col">Price</th>
                    <th scope="col">Name</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($wish as $list)
                    <tr>
                      <td>{{ ++$loop->index }}</td>
                      <td>{{ $list->created_at->format('d/m/Y') }}</td>
                      <td>
                        <img
                          class="img-fluid"
                          src="{{ asset('./../pos/') }}/{{ $list->product->item_image }}"
                          alt=""
                        />
                      </td>
                      <td>৳{{ $list->product->price}}</td>
                      <td><a href="{{ route('product_details.singleProduct',$list->product->id) }}">{{ $list->product->item_name}}</a></td>
                      <td>
                        <form id="form{{$list->id}}" action="{{ route('wishlist.destroy',$list->id) }}" method="POST">
                            @csrf
                            @method('post')
                            <button class="btn p-0 show_confirm" data-toggle="tooltip" type="submit"><i class='bi bi-trash-fill' style='color:red'></i></button>
                        </form>
                    </td>
                    </tr>
                  @endforeach

                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
