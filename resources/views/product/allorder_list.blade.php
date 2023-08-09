@extends('customer_master')

@section('content')

<div class="col right-side" style="padding: 0">
    <div class="cart p-4">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-list"><a href="{{ route('home') }}">Home/</a></li>
          <li class="breadcrumb-item active" aria-current="page">Order List</li>
        </ol>
      </nav>
      <div class="prorduct-table">
        <div class="row">
            <p class="text-center">Recent Product You Have Order</p>
            <hr />
          <div class="col-sm-12 p-3">
            <div class="rounded bg-white my-3 shadow p-2">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col"> #SL</th>
                            <th scope="col">Date</th>
                            <th scope="col">Bill Id</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($allorder as $list)
                            <tr>
                              <td>{{ ++$loop->index }}</td>
                              <td>{{ $list->created_at->format('d/m/Y') }}</td>
                              <td>{{ str_pad($list->billing_id,4,'0',STR_PAD_LEFT) }}</td>
                              <td>৳{{ $list->total}}</td>
                              <td>@if($list->status==0) Pending
                                  @elseif($list->status==1) Processing
                                  @elseif($list->status==2) Delivered
                                  @elseif($list->status==3) Cancel
                                  @endif
                              </td>
                              <td><a href="{{ route('invoice',$list->id) }}">View</a></td>
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
</div>

@endsection
