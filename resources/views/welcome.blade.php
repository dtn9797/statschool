@extends('layouts.app')
@section('content')
<div class="lg:px-24">
  @if($show_tutorial)
    @include('components.tutorial')
  @endif

  <h1 class="text-4xl text-gray-800 text-center">Get Points</h1>
  <h2 class="text-2xl text-gray-800 text-center mb-4">
    Download apps to gain points that you can exchange for Features and Promo
  </h2>

  <div class="flex justify-center flex-wrap">
    @foreach ($offers as $offer)
      @include('components.cards.offer', ['offer' => $offer])
    @endforeach
  </div>
</div>
@endsection
