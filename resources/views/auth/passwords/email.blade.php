@extends('layouts.app')

@section('content')
<div class="container flex justify-center pt-8 lg:pt-20">
  <div class="col-md-8">
    <div class="card">
      <div class="w-64 mb-2">
        <h3 class="text-3xl my-4 w-full text-gray-700 text-center">{{ __('Reset Password') }}</h3>
      </div>
      <div class="w-64 mb-2">
        @if (session('status'))
        <div class="bg-red-200" role="alert">
          {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
          @csrf

          <label for="email" class="w-full text-gray-700 font-bold">{{ __('E-Mail Address') }}</label>

          <div class="col-md-6">
            <input id="email" type="email"
              class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full @error('email') bg-red-200 @enderror"
              name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

            @error('email')
            <span class="text-red-500" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>

          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
            {{ __('Send Password Reset Link') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection