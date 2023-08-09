@extends('master')

@section('content')

      <!-- left side div end -->
      <!-- right side div start -->
      <div class="col right-side" style="padding: 0">
        <!-- slide start -->
        <div class="m-3 slider">
          <div
            id="carouselExampleCaptions"
            class="carousel slide shadow"
            data-bs-ride="false"
          >
            <div class="carousel-indicators">
              <button
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide-to="0"
                class="active"
                aria-current="true"
                aria-label="Slide 1"
              ></button>
              <button
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide-to="1"
                aria-label="Slide 2"
              ></button>
              <button
                type="button"
                data-bs-target="#carouselExampleCaptions"
                data-bs-slide-to="2"
                aria-label="Slide 3"
              ></button>
            </div>
            <div class="carousel-inner">
              @forelse ($slide as $s)
                <div class="carousel-item active">
                  <a href="#"
                    ><img
                      src="{{ asset('./../pos/uploads/slider_image') }}/{{ $s->slider_image }}"
                      class="d-block w-100"
                      alt="..."
                  /></a>
                  <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $s->title }}</h5>
                    <p>
                      {{ $s->short_description }}
                    </p>
                  </div>
                </div>

              @empty
                  <p>no data</p>
              @endforelse
            </div>
            <button
              class="carousel-control-prev"
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide="prev"
            >
              <span
                class="carousel-control-prev-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button
              class="carousel-control-next"
              type="button"
              data-bs-target="#carouselExampleCaptions"
              data-bs-slide="next"
            >
              <span
                class="carousel-control-next-icon"
                aria-hidden="true"
              ></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <!-- slide end -->
        <!-- product Row 1 start-->
        <div class="container product-row-1 my-4">
          <div class="product-heading">
            <div class="row">
              <div class="col-8">
                <p class="h6">
                  <img
                    class="body-title-icon"
                    src="{{ asset('./../pos/uploads/fsettings_image') }}/{{ $frontsettt->popular_icon }}"
                    //src="{{ asset('assets/resource') }}/img/icon/image 49.png"
                    alt=""
                  /><strong>আমাদের জনপ্রিয় পণ্য</strong>
                </p>
              </div>
              <div class="col-4 d-flex justify-content-end">
                <p class="view">
                  <a href="{{ route('product.populer') }}">View All</a>
                </p>
              </div>
            </div>
          </div>

          <div class="product-row my-3">
            <div class="row justify-content-center">
                @forelse ($product as $p)

                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow mb-3" style="max-width: 200px; max-height:355px; margin:auto">
                      <a href="#">
                        <a href="{{ route('product_details.singleProduct',$p->id) }}">
                      <img class="card-img-top" src="{{ asset('./../pos/') }}/{{ $p->item_image }}" width="200px" height="200px"/>
                      </a>
                      <div class="card-body">
                        <p class="card-title text-center">{{ $p->item_name }}</p>
                        <p class="card-title text-center m-0 p-0">{{ $p->sales_price .' '.'TK' }}</p>
                        <form class="" action="{{ route('add-to.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                            <input type="hidden" id="qtyBox" placeholder="1" value="1" name="order_qty" />
                            <div class="card-button">
                                <input class="cartsubmit" type="submit" value="+Add To Cart" />
                                {{--  <a href="{{ route('product_details.singleProduct',$p->id) }}">+ Add to Card</a>  --}}
                                <a href="#"></a>
                                {{--  <a href="{{ route('addwishlist',$p->id) }}"><i class="bi bi-heart-fill"></i></a>  --}}
                              </div>
                        </form>
                      </div>
                    </div>
                </div>
                @empty
                    <p>no Product</p>
                @endforelse
                {{--  <div class="pt-2">
                    {{$product->links()}}
                </div>  --}}
            </div>
          </div>
        </div>
        <!-- product Row 1 end-->
        <!-- product Row 2 start-->
        <div class="container product-row-1 my-5">
          <div class="product-heading">
            <div class="row">
              <div class="col-8">
                <p class="h6">
                  <img
                    class="body-title-icon"
                    src="{{ asset('./../pos/uploads/fsettings_image') }}/{{ $frontsettt->offer_icon }}"
                    alt=""
                  /><strong>আমাদের অফার পণ্য</strong>
                </p>
              </div>
              <div class="col-4 d-flex justify-content-end">
                <p class="view">
                  <a href="{{ route('product.index') }}">View All</a>
                </p>
              </div>
            </div>
          </div>

          <div class="product-row my-3">
            <div class="row justify-content-center">
                @forelse ($offer_product as $off)
                <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                    <div class="card shadow mb-3" style="max-width: 200px; max-height:355px; margin:auto">
                      <a href="#">
                        <a href="{{ route('product_details.singleProduct',$off->id) }}">
                      <img class="card-img-top" src="{{ asset('./../pos/') }}/{{ $off->item_image }}"  width="200px" height="200px"/>
                      </a>
                      <div class="card-body">
                        <p class="card-title text-center">{{ $off->item_name }}</p>
                        <p class="card-title text-center m-0 p-0">{{ $off->sales_price .' '.'TK' }}</p>
                        <form class="" action="{{ route('add-to.cart') }}" method="post">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $off->id }}">
                            <input type="hidden" id="qtyBox" placeholder="1" value="1" name="order_qty" />
                            <div class="card-button">
                                <input class="cartsubmit" type="submit" value="+Add To Cart" />
                                {{--  <a href="{{ route('product_details.singleProduct',$p->id) }}">+ Add to Card</a>  --}}
                                <a href="#"></a>
                                {{--  <a href="{{ route('addwishlist',$p->id) }}"><i class="bi bi-heart-fill"></i></a>  --}}
                              </div>
                        </form>
                      </div>
                    </div>
                  </div>
                @empty
                    <p>no Product</p>
                @endforelse
                {{--  <div class="pt-2">
                    {{$offer_product->links()}}
                </div>  --}}
            </div>
          </div>
        </div>
        <!-- product Row 2 end-->
        <!-- Product Catagory Section start -->
        <div class="product-catagory my-5 p-4">
          <p class="mb-4">আমাদের পণ্য বিভাগ</p>
          <div class="row justify-content-center">

            <?php $category = DB::table('db_category')->where('is_slied', '1')->select('category_name','image','is_slied')->get(); ?>

            @forelse ($category as $cat)
                <div class="col-sm-6 col-lg-4 col-xl-3 mb-3">
                  <div class="catagory-card shadow">
                    <div class="row">
                    <div class="col-2">
                        <img
                        class="img-fluid"
                        src="{{ asset('./../pos/uploads/category') }}/{{ $cat->image }}"
                        alt=""
                        />
                    </div>
                    <div class="col-10">
                        <p>{{ $cat->category_name }}</p>
                    </div>
                    </div>
                  </div>
                </div>
            @empty
              <p>no category</p>
            @endforelse
          </div>
        </div>
        <!-- Product Catagory Section end -->
        <!-- Our Offers Section start -->
        <div class="our-offers">
          <p class="mb-4">আমাদের অফার</p>
          <div class="m-3 slider">
            <div
              id="carouselExampleCaptionsa"
              class="carousel slide shadow-lg"
              data-bs-ride="false"
            >
              <div class="carousel-indicators">
                <button
                  type="button"
                  data-bs-target="#carouselExampleCaptionsa"
                  data-bs-slide-to="0"
                  class="active"
                  aria-current="true"
                  aria-label="Slide"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleCaptionsa"
                  data-bs-slide-to="1"
                  aria-label="Slide"
                ></button>
                <button
                  type="button"
                  data-bs-target="#carouselExampleCaptionsa"
                  data-bs-slide-to="2"
                  aria-label="Slide"
                ></button>
              </div>
              <div class="carousel-inner">
                    @forelse ($footslider as $of)
                    <div class="carousel-item active">
                        <a href="#"
                        ><img
                            src="{{ asset('./../pos/uploads/fslider_image') }}/{{ $of->fslider_image }}"
                            class="d-block w-100"
                            alt="..."
                        /></a>
                        <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $of->title }}</h5>
                        <p>
                            {{ $of->short_description }}
                        </p>
                        </div>
                    </div>

                    @empty
                        <p>no offer</p>
                    @endforelse
              </div>
              <button
                class="carousel-control-prev"
                type="button"
                data-bs-target="#carouselExampleCaptionsa"
                data-bs-slide="prev"
              >
                <span
                  class="carousel-control-prev-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button
                class="carousel-control-next"
                type="button"
                data-bs-target="#carouselExampleCaptionsa"
                data-bs-slide="next"
              >
                <span
                  class="carousel-control-next-icon"
                  aria-hidden="true"
                ></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
        </div>
        <!--  Our Offers Section end -->
        <div class="container faq my-5">
          <p>প্রশ্ন</p>
          <div class="row faq-body">
              @forelse ($faq as $f)
            <div class="col-sm-6">
                <div
                class="accordion accordion-flush shadow mb-4"
                id="fid{{ $f->id }}"
                >
                <div class="accordion-item">
                <h2 class="accordion-header" id="f{{ $f->id }}">
                    <button
                    class="accordion-button collapsed rounded"
                    type="button"
                    data-bs-toggle="collapse"
                    data-bs-target="#fls{{ $f->id }}"
                    aria-expanded="false"
                    aria-controls="fls{{ $f->id }}"
                    >
                    {{ $f->question }}
                    </button>
                </h2>
                <div
                    id="fls{{ $f->id }}"
                    class="accordion-collapse collapse"
                    aria-labelledby="f{{ $f->id }}"
                    data-bs-parent="#fid{{ $f->id }}"
                >
                    <div class="accordion-body">
                    {{ $f->description }}
                    </div>
                </div>
                </div>
                </div>

            </div>
                @empty
                <p>No Faq </p>
            @endforelse
          </div>
        </div>
          <!-- Footer -->
        @include('layout.footer')

@endsection
