@extends('layouts.app')

@section('content')
<div class="container flex justify-center pt-8 lg:pt-20">
  <div class="w-64 mb-2">
    <div class="card">
      <div class="w-64 mb-2">
        <h3 class="text-3xl my-4 w-full text-gray-700 text-center">{{ __('Verify Your Email Address') }}</h3>
      </div>

      @if (session('resent'))
      <div class="bg-alert-200" role="alert">
        {{ __('A fresh verification link has been sent to your email address.') }}
      </div>
      @endif

      {{ __('Before proceeding, please check your email for a verification link.') }}
      {{ __('If you did not receive the email') }},
      <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit"
          class="bg-white focus:outline-none focus:shadow-outline border border-gray-300 rounded-lg py-2 px-4 block w-full appearance-none leading-normal w-full">{{ __('click here to request another') }}</button>.
      </form>
    </div>
  </div>
</div>
@endsection