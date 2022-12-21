@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 {{-- <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('password.update') }}">
        @csrf 
        <input type="hidden" name="token" value="{{ $token }}">
        
        <span class="login100-form-title p-b-32 font-Moul">
            ផ្លាស់ប្តូរលេខសម្ងាត់
        </span>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5">
            អ៊ីមែល
        </span>
        <div class="wrap-input100 validate-input m-b-36" >
            <input class="input100" id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5">
            លេខសម្ងាត់
        </span>
        <div class="wrap-input100 validate-input m-b-12">
            <input class="input100" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5 mt-3">
            បញ្ចាក់លេខសម្ងាត់
        </span>
        <div class="wrap-input100 validate-input m-b-12">
            <input class="input100" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <span class="focus-input100"></span>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn font-dangrek-bold" type="submit">
            យល់ព្រម
            </button>
        </div>
    </form>
</div> --}}
@endsection
