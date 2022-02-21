@extends('layouts.app')

@section('content')
<div class="container flex justify-center pt-8 lg:pt-20">
  <form method="POST" action="{{ route('login') }}">
    @csrf

    <div class="w-64 mb-2">
      <h3 class="text-3xl my-4 w-full text-gray-700 text-center">Login</h3>
    </div>

    <div class="w-64 mb-2">
      <label for="email" class="w-full text-gray-700 font-bold">{{ __('E-Mail Address') }}</label>

      <input id="email" type="email"
        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('email') bg-red-200 @enderror"
        name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

      @error('email')
      <span class="text-red-500" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="w-64 mb-2">
      <label for="password" class="w-full text-gray-700 font-bold">{{ __('Password') }}</label>

      <input id="password" type="password"
        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('password') bg-red-200 @enderror"
        name="password" required autocomplete="current-password">

      @error('password')
      <span class="text-red-500" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="w-64 mb-2">
      <div class="form-check">
        <input class="form-check-input" type="checkbox" name="remember" id="remember"
          {{ old('remember') ? 'checked' : '' }}>

        <label class="w-full text-gray-700 font-bold" for="remember">
          {{ __('Remember Me') }}
        </label>
      </div>
    </div>

    <div class="w-64 mb-2">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
        {{ __('Login') }}
      </button>
      <br />
      @if (Route::has('password.request'))
      <a class="w-full text-blue-600" href="{{ route('password.request') }}">
        {{ __('Forgot Your Password?') }}
      </a>
      @endif
    </div>
  </form>
</div>
@endsection