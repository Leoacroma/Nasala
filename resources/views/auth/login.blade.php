@extends('layouts.app')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    @error('email')
        <div class="notice notice-danger font-dangrek">
            <strong>{{ $message }}</strong> 
        </div>
    @enderror

    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
        @csrf 
        <img class="m-auto" src="{{ asset('assets/images/photo_2022-10-19_09-17-50-removebg-preview.png') }}" alt="" width="200px">
        <span class="login100-form-title p-b-32 font-Moul">
            សាលាជាតិរដ្ឋបាលមូលដ្ឋាន
        </span>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5">
            អ៊ីមែល
        </span>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
            <input class="input100"  id="email" type="email" @error('failed') is-invalid @enderror"   name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            <span class="focus-input100"></span>
        </div>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5">
            លេខសម្ងាត់
        </span>
        <div class="wrap-input100 validate-input m-b-12" data-validate="Password is required">
            <input class="input100" id="password" type="password" @error('password') is-invalid @enderror"  name="password" required autocomplete="current-password">
            <span class="focus-input100"></span>
        </div>
        <div class="flex-sb-m w-full p-b-48">
            <div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="txt3 font-dangrek-bold">
                    ភ្លេចលេខសម្ងាត់?
                </a>
                @endif
            </div>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn font-dangrek-bold" type="submit">
            ចូល
            </button>
        </div>

    </form>
</div>

@endsection
