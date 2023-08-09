@extends('master')

@section('content')
<div class="col right-side" style="padding: 0">
    <div class="form p-4">
      <div class="bg-white rounded shadow p-3">
        <p>Registation</p>
        <hr />
        @if ($errors->any())
        <div class="alert alert-danger mb-4">
            <ul>
                @foreach ($errors->all() as $error)
                <p class="invalid-tooltips">{{ $error }}</p>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="m-auto my-3 w-75">
          <form action="{{ route('customer.store') }}" method='post'>
                @csrf
                <div class="mb-3">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Full Name</label
                    >
                    <input
                    type="text"
                    class="form-control @error('customer_name') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="customer_name" value="{{ old('customer_name') }}" placeholder="Enter Your Name"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('customer_name'))
                        <small class="d-block text-danger">
                            {{$errors->first('customer_name')}}
                        </small>
                    @endif
                </div>
                {{--  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Last Name</label
                    >
                    <input
                    type="text"
                    class="form-control @error('last_name') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="last_name" value="{{ old('last_name') }}" placeholder="Enter Your Last Name"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('last_name'))
                    <small class="d-block text-danger">
                        {{ $errors->first('last_name') }}
                    </small>
                    @endif
                </div>  --}}
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Mobile Number</label
                    >
                    <input
                    type="text"
                    class="form-control @error('mobile') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="mobile" value="{{ old('mobile') }}" placeholder="Enter Your Phone Number"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('mobile'))
                    <small class="d-block text-danger">
                        {{ $errors->first('mobile') }}
                    </small>
                    @endif
                </div>
                {{--  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label"
                    >Address</label
                    >
                    <input
                    type="text"
                    class="form-control @error('address') is-invalid @enderror"
                    id="exampleInputEmail1"
                    name="address" value="{{ old('address') }}" placeholder="Enter Your Place"
                    aria-describedby="emailHelp"
                    />
                    @if($errors->has('address'))
                    <small class="d-block text-danger">
                        {{ $errors->first('address') }}
                    </small>
                    @endif
                </div>
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
                <div id="emailHelp" class="form-text">
                    We'll never share your email with anyone else.
                </div>  --}}
                </div>
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label"
                    >Password</label
                >
                <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    id="exampleInputPassword1"
                    name="password" value="{{ old('password') }}" placeholder="Enter Your Passwoard"
                />
                @if($errors->has('password'))
                <small class="d-block text-danger">
                    {{ $errors->first('password') }}
                </small>
                @endif
                </div>
                <div class="mb-3 form-check">
                {{--  <input
                    type="checkbox"
                    class="form-check-input"
                    id="exampleCheck1"
                    name="check_me_out"
                    value="1"
                />
                <label class="form-check-label" for="exampleCheck1"
                    >Check me out</label
                >   --}}
            </div>
            <button type="submit" class="submit shadow">Submit</button> OR
            <a class="ms-2 submit shadow" href="{{ route('login') }}"><span>Login</span></a>
                {{-- <a class="submit shadow" href="#">Submit</a> --}}
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
