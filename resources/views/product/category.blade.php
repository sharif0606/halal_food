@extends('master')

@section('content')
<div class="col right-side" style="padding: 0">
    <!-- offer banner start -->
    <div class="cg-offer-banner container p-3">
      <div class="row">
        @forelse ($advertise_img as $cat)
        <div class="col">
          <a href="#">
            <img src="{{ asset('./../pos/uploads/category') }}/{{ $cat->advertise_image }}" alt="" />
          </a>
        </div>
        @empty
        <div class="col">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/cg-1 (1).png" alt="" />
          </a>
        </div>
        @endforelse
      </div>
    </div>
    <!-- offer banner end -->
    <!-- Subcategory start -->
    <div class="cg-sub-category p-3">
      <!-- Breadcrumb start -->
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active fw-bold" aria-current="page">
            Food
          </li>
        </ol>
      </nav>
      <!-- Breadcrumb ends -->
      <!-- sub catagory -->
      <div class="row">
        @forelse ($category as $cat)
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
            <a href="{{ route('subcategory.list',['category_id' =>$cat->id]) }}">
              <img src="{{ asset('./../pos/uploads/category') }}/{{ $cat->banner_image }}" alt="" />
              <p>{{ $cat->category_name }}</p></a
            >
          </div>

        @empty
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
            <a href="#">
              <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
              <p>fresh-vegetable</p></a
            >
          </div>
        @endforelse
        {{-- <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div>
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
          <a href="#">
            <img src="{{ asset('assets/resource') }}/img/fruits-vegetables.webp" alt="" />
            <p>fresh-vegetable</p></a
          >
        </div> --}}
      </div>
    </div>
    <!-- Subcatagory end -->
</div>

@endsection
