@extends('layouts.app')

@section('content')
<div class="container flex justify-center pt-8 lg:pt-20">
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="w-64 mb-2">
      <h4 class="text-3xl my-4 w-full text-gray-700 text-center">
        Create an Account to Earn Free Money & Get Free Features!
      </h4>
    </div>

    <div class="w-64 mb-2">
      <label for="name" class="w-full text-gray-700 font-bold">{{ __('Name') }}</label>

      <input id="name" type="text"
        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('name') bg-red-200 @enderror"
        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

      @error('name')
      <span class="text-red-500" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="w-64 mb-2">
      <label for="email" class="w-full text-gray-700 font-bold">{{ __('E-Mail Address') }}</label>

      <input id="email" type="email"
        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('email') bg-red-200 @enderror"
        name="email" value="{{ old('email') }}" required autocomplete="email">

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
        name="password" required autocomplete="new-password">

      @error('password')
      <span class="text-red-500" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror
    </div>

    <div class="w-64 mb-2">
      <label for="password-confirm" class="w-full text-gray-700 font-bold">{{ __('Confirm Password') }}</label>

      <input id="password-confirm" type="password"
        class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full"
        name="password_confirmation" required autocomplete="new-password">
    </div>

    <div class="w-64 mb-2">
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
        {{ __('Register') }}
      </button>
    </div>
  </form>
</div>
@endsection
