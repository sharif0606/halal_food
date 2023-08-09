<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Halal meat</title>
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/main.css" />
    <link rel="stylesheet" href="{{ asset('assets/resource') }}/css/client-area.css" />
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
  </head>
  <body>
    <!-- ========= header start ============ -->
    <section class="header brand-color w-100">
      <!-- logo div -->
      <div class="container py-4">
        <div class="row header-top">
          <div class="col-sm-4">
            <p>
              647-352-5009 <br />
              <span>310 DANFORTH AVENUE</span>
            </p>
          </div>
          <div class="col-sm-4 text-center">
            <a href="{{ route('home') }}">
              <img
                class="img-fluid main-logo"
                src="{{ asset('assets/resource') }}/img/logo.png"
                alt="logo"
              />
            </a>
          </div>
          <div class="col-sm-4 d-flex justify-content-end header-right-logo">
            <img
              class="img-fluid"
              src="{{ asset('assets/resource') }}/img/halal.png"
              alt="Halal Food"
            />
          </div>
        </div>
      </div>
      <!-- logo end -->
    </section>
    <!-- nav start -->
    <nav class="navbar navbar-expand-lg bg-light shadow sticky-top">
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

        <a href="#">
          <div class="nav-logo">
            <img
              class="navbar-brand img-fluid bg-dark rounded"
              src="{{ asset('assets/resource') }}/img/logo.png"
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
          <div class="nav-search mobile-bg">
            <div class="input-group input-group-sm my-3">
              <input
                type="text"
                class="form-control"
                placeholder="ex: enter your Products..."
                aria-label="Sizing example input"
                aria-describedby="inputGroup-sizing-sm"
              />
              <span class="input-group-text" id="inputGroup-sizing-sm"
                ><i class="bi bi-search"></i
              ></span>
            </div>
          </div>
        </div>
        <div class="ms-auto customer-seciton mobile-bg p-1">
          <a href="#"><i class="bi bi-person-circle"></i></a>
          <a href="#"><i class="bi bi-truck"></i></a>
          <a href="#"><i class="bi bi-basket"></i></a>
          <a href="#"><i class="bi bi-heart"></i></a>
        </div>
      </div>
    </nav>
    <!-- nav end -->
    <!-- main seciton -->
    <main class="container-fluid">
      <div class="row">
        <!-- left site div start -->
        @include('layout.sidebar')
        <!-- left side div end -->
        <!-- right side div start -->

        @yield('content')

      </div>
    </main>

    <!-- Bootsep JS -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
    <!-- Apps JS -->
    <script src="{{ asset('assets/resource') }}/js/apps.js"></script>
    <script src="{{ asset('assets/resource') }}/js/jquery-3.6.3.min.js"></script>
    @stack('scripts')
  </body>
</html>
