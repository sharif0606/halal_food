<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halal Food</title>
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/main.css" />
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/category.css" />
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/child-category.css" />
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/cart.css" />
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/single.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <!-- Bootstrp 5 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />
    <!-- Bootsrap 5 Icon -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
    <link href="https://fonts.maateen.me/adorsho-lipi/font.css" rel="stylesheet">

  </head>
  <body>
    <!-- ========= header start ============ -->
    <section class="header brand-color w-100">
      <!-- logo div -->
      <div class="row m-0 p-0">
        <div class="col-sm-4 text-center d-none d-sm-block">
          <img src="{{ asset('assets/resource') }}/img/left-logo.png" alt="Your Image" class="img-fluid float-start romadan_img">
        </div>
        <div class="col-sm-4 text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('./../pos/uploads/fsettings_image') }}/{{ \App\Models\FrontSettings::first()->logo_img }}" alt="Your Image" class="img-fluid float-middle middle_logo">
            </a>
        </div>
        <div class="col-sm-4 text-center d-none d-sm-block">
          <img src="{{ asset('assets/resource') }}/img/right-logo.png" alt="Your Image" class="img-fluid float-end romadan_img">
        </div>
      </div>
      <!-- logo end -->
    </section>

    <!-- nav start -->
    <nav class="navbar navbar-expand-lg bgcolor shadow sticky-top">
        <div class="container">
            <div class="mobile-nav-btn">
                <div class="start-btn">
                    <button type="button" onclick="leftNavS()" class="btn btn-light">
                    <i class="bi bi-list"></i>
                    </button>
                </div>
                <div class="close-btn">
                    <button type="button" onclick="leftNavC()" class="btn btn-light">
                    <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            </div>

            <a href="{{ route('home') }}">
                <div class="nav-logo">
                    <img
                    class="navbar-brand img-fluid rounded height-40"
                    src="{{ asset('./../pos/uploads/fsettings_image') }}/{{ \App\Models\FrontSettings::first()->logo_img }}"
                    alt="logo"
                    />
                </div>
            </a>

            <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation"
            >
            <span class="bi bi-search"></span>
            </button>

            <div
            class="collapse mobile-bg navbar-collapse p-3"
            id="navbarSupportedContent"
            >
            <form action="{{ route('search_product') }}" method="get">
                <div class="nav-search mobile-bg">
                    <div class="input-group input-group-sm my-3">
                        <input required
                            type="text" name="item_name"
                            class="form-control"
                            placeholder="search your product..."
                            aria-label="Sizing example input"
                            aria-describedby="inputGroup-sizing-sm"
                        />
                        <button class="input-group-text" id="inputGroup-sizing-sm" type="submit"
                            ><i class="bi bi-search"></i
                        ></button>
                    </div>
                </div>
            </form>
            </div>
            <div class="ms-auto customer-seciton mobile-bg p-1">
                <div class="dropdown">
                    <a id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" style="text-decoration:none;">
                        <i class="bi bi-person-circle"></i>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink" style="background-color: #FFFF66;">
                        @if(Session::get('userId'))
                        <li><a class="dropdown-item" href="{{ route('customer.dashboard') }}">Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('logOut') }}">Logout</a></li>
                        @else
                        <li><a class="dropdown-item" href="{{ route('register') }}">Registration</a></li>
                        <li><a class="dropdown-item" href="{{ route('login') }}">Login</a></li>
                        @endif
                    </ul>
                    <a href="#"><i class="bi bi-truck"></i></a>
                    {{--  <a href="#"><i class="bi bi-heart"></i></a>  --}}
                    <a href="{{ route('cart.page') }}"><i class="bi bi-basket"></i>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ \Gloudemans\Shoppingcart\Facades\Cart::content()->count() }}
                        </span>
                    </a>
                </div>
            {{-- <a href="#"><i class="bi bi-person-circle"></i></a> --}}

            </div>
        </div>
    </nav>
    <!-- nav end -->
    <!-- main seciton -->
    <main class="container-fluid">
        <div class="row">
            @include('layout.sidebar')
            @yield('content')
        </div>
    </main>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 p-5">
                    <div class="footer-logo">
                        <img class="img-fluid" src="{{ asset('./../pos/uploads/fsettings_image') }}/{{ \App\Models\FrontSettings::first()->logo_img }}" alt="sorry no image found" />
                    </div>
                    <p class="footer-about-footer text-white">{{ \App\Models\FrontSettings::first()->description }}
                    </p>
                    <div class="social-icon">
                        <a href="{{ \App\Models\FrontSettings::first()->facebooklink }}"><i class="bi bi-facebook"></i></a>
                        <a href="{{ \App\Models\FrontSettings::first()->twitterlink }}"><i class="bi bi-twitter"></i></a>
                        <a href="{{ \App\Models\FrontSettings::first()->linkdinlink }}"><i class="bi bi-linkedin"></i></a>
                        <a href="{{ \App\Models\FrontSettings::first()->youtubelink }}"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
                <div class="col-sm-6 p-5">
                    <div class="d-flex apps-div">
                        <img src="{{ asset('assets/resource') }}/img/androied.png" alt="" />
                        <img src="{{ asset('assets/resource') }}/img/apple.png" alt="" />
                    </div>
                    <div class="address text-white">
                        <i class="bi bi-geo-alt-fill"> </i>
                        <p>{{ \App\Models\FrontSettings::first()->address }}
                        </p>
                        <br />
                        <br />
                        <i class="bi bi-telephone-fill"></i>
                        <p>{{ \App\Models\FrontSettings::first()->phone }}</p>
                        <br />
                        <br />
                        <i class="bi bi-envelope-fill"></i>
                        <p style="font-family: 'bootstrap-icons';">{{ \App\Models\FrontSettings::first()->email }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Bootsep JS -->

    </body>
    </html>


<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
crossorigin="anonymous"
></script>
<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{{--  {!! Toastr::message() !!}  --}}
<!-- Apps JS -->
<script src="{{ asset('assets/resource') }}/js/apps.js"></script>
<script src="{{ asset('assets/resource') }}/js/jquery-3.6.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"referrerpolicy="no-referrer"></script>
<script>
    $('.dropify').dropify();
</script>
@stack('scripts')
