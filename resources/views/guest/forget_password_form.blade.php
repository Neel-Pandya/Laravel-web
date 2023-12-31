@extends('guest.master')

@section('titles')
    Forget Password
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">


    <div class="container mt-4 col-6">
    
        @if (session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!! </strong> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!! </strong> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
        @if (session()->has('warning'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Error!! </strong> {{ session('warning') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <input type="checkbox" id="check">
        <div class="login form">
            <header class="logo-name" style="font-family: cursive">Forget Password</header>

            <form method="POST" enctype="multipart/form-data"
                action="{{ URL::to('/') }}/guest_user/forget_password_form_submit">
                @csrf
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-4">
                        <input type="email" placeholder="Enter your email" name="em" required>
                        <span class="text-danger">
                            @error('customer_name')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <input type="submit" class="button" value="Forget Password">
                </div>
            </form>
            <div class="signup">
                <span class="signup">Already have an account?
                    <a href="{{ route('guest.login') }}">Login</a>
                </span>
            </div>
        </div>
    </div>
@endsection
