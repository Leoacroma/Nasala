@extends('layouts.app')

@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif
    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('password.email') }}">
        @csrf 
        <span class="login100-form-title p-b-32 font-Moul">
            ផ្លាស់ប្តូរលេខសម្ងាត់
        </span>
        <span class="txt1 p-b-11 font-Hanuman-bold fs-5">
            អ៊ីមែល
        </span>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Username is required">
            <input class="input100"   id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
             @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <span class="focus-input100"></span>
        </div>
        <div class="container-login100-form-btn">
            <button class="login100-form-btn font-dangrek-bold" type="submit">
យល់ព្រម
</button>
    </form>
</div>
@endsection
