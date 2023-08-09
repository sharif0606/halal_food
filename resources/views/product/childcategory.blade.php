@extends('master')

@section('content')
<div class="col right-side" style="padding: 0">
    <!-- offer banner start -->
    <div class="cg-offer-banner container p-3">
      <div class="row">
        @forelse ($child_advertise as $childcat)
        <div class="col">
            <a href="#">
              <img src="{{ asset('./../pos/uploads/childcategory') }}/{{ $childcat->advertise_image }}" alt="" />
            </a>
          </div>
        @empty
        <div class="col">
            <h4 class="text-center mt-5">No Advertise Image</h4>
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
          <li class="breadcrumb-item fw-bold"><a href="{{ route('category.list',[$cat->id]) }}">{{$cat->category_name}}</a></li>
          <li class="breadcrumb-item active fw-bold" aria-current="page">{{$sub_cat->subcategory_name}}</li>
        </ol>
      </nav>
      <!-- Breadcrumb ends -->
      <!-- sub catagory -->
      <div class="row">
        @forelse ($show_childcategory as $childcat)
        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 mb-3">
            <a href="{{ route('category.product.list',[$childcat->sub_category?->category_id,$childcat->subcategory_id,$childcat->id]) }}">
              <img src="{{ asset('./../pos/uploads/childcategory') }}/{{ $childcat->banner_image }}" width="150" height="150" alt="" />
              <p class="pe-5">{{ $childcat->childcategory_name }}</p></a
            >
          </div>
        @empty
        <h3 class="text-center mt-5">No Child-Category Found</h3>
        @endforelse
      </div>
    </div>
    <!-- Subcatagory end -->
  </div>


@endsection
