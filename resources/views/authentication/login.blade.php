@extends('master')

@section('content')
    <div class="col right-side" style="padding: 0">
        <div class="form p-4">
            <div class="bg-white rounded shadow p-3">
                @if(Session::has('response'))
                {!!Session::get('response')['message']!!}
                @endif
                <p>Login</p>
                <hr />
                <div class="m-auto my-3 w-75">
                    <form action="{{route('login.check')}}" method="post">
                        @csrf
                        <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"
                            >Phone Number</label
                        >
                        <input
                            type="text"
                            class="form-control"
                            id="exampleInputEmail1"
                            name="mobile"
                            aria-describedby="emailHelp"
                        />
                        {{--  <div id="emailHelp" class="form-text">
                            We'll never share your mobile with anyone else.
                        </div>  --}}
                        </div>
                        <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"
                            >Password</label
                        >
                        <input
                            type="password"
                            class="form-control"
                            id="exampleInputPassword1"
                            name="password"
                        />
                        </div>
                        <div class="mb-3 form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="exampleCheck1"
                        />
                        <label class="form-check-label" for="exampleCheck1"
                            >Check me out</label
                        >
                        </div>
                        <button type="submit" class="submit shadow">{{__('Log in')}}</button> OR
                        <a class="submit shadow mt-2" href="{{ route('register') }}">{{__('Registration')}}</a>
                        {{-- <a class="submit shadow" href="#">Submit</a> --}}
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection
