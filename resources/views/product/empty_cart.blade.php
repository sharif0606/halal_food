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
      <div class="prorduct-table">
        <div class="row">
          <div class="col-sm-12 p-3">
            <div class="rounded bg-white my-3 shadow p-2">
                <div class="text-center m-5 p-5">
                    <h3 m-5 p-5>আপনি এখন পর্যন্ত কোন পণ্য নির্বাচন করেননি। পণ্য নির্বাচন করতে এখানে <a href="{{ route('home') }}">ক্লিক করুন</a>!! </h3>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
