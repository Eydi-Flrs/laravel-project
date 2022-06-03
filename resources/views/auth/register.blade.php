@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="{{asset('css/sb-admin-2.css')}}">
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">

            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">

                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">

                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-1000 mb-4 " style="text-align:center">Create an Account!</h1>
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="firstname" class="col-md-4 col-form-label text-md-front">{{ __('First Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                        @error('firstname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="lastname" class="col-md-4 col-form-label text-md-front">{{ __('Last Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="name" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>

                                        @error('lastname')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-form-label text-md-front">{{ __('TUP Email Address') }}</label>

                                    <div class="col-md-6">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="contact_number" class="col-md-4 col-form-label text-md-front">{{ __('Contact number') }}</label>

                                    <div class="col-md-6">
                                        <input  onkeypress="return onlyNumberKey(event)" id="contact_number" maxlength="11" type="text" class="form-control @error('contact_number') is-invalid @enderror" name="contact_number" value="{{ old('contact_number') }}" required autocomplete="contact_number">

                                        @error('contact_number')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password" class="col-md-4 col-form-label text-md-front">{{ __('Password') }}</label>

                                    <div class="col-md-6">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-front">{{ __('Confirm Password') }}</label>



                                    <div class="col-md-6">
                                        <div>
                                            <input data-toggle="password" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                        </div>

                                    </div>
                                </div>

                                <div class="form-check mb-4">
  <input class="form-check-input" type="checkbox" name="checkbox" value="1" id="flexCheckChecked" >
  <label class="form-check-label" for="flexCheckChecked">
    I acknowledge that I have read and agree to the above <a href="/terms-and-conditions">Terms and Conditions</a> and <a href="/privacy-policy"> Privacy Policy.</a>
  </label>
</div>
                                <div class="row mb-3">
                                    <div class="col-md-6 offset-md-4 text-md-center">
                                        <button type="submit" class="btn btn-warning" style="width: 100%">
                                            {{ __('Register') }}
                                        </button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-ms-5 offset-ms-5 text-md-center " >
                                @if (Route::has('login'))
                                    <a class="btn btn-link "  href="{{ route('login') }}">
                                        {{ __('Already have an Account? Login') }}
                                    </a>
                                    </div>
                                </div>
                                @endif
                            </form>
                    </div>
                </div>
            </div
        </div>

    </div>

        <script>

            function onlyNumberKey(evt) {
                // Only ASCII character in that range allowed
                var ASCIICode = (evt.which) ? evt.which : evt.keyCode
                if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
                    return false;
                return true;
            }
        </script>
@endsection
