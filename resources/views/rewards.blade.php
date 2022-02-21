@extends('layouts.app')

@section('content')
<div class="lg:px-24">
  <h1 class="text-4xl text-gray-800 text-center">Rewards</h1>

  <div class="flex justify-center flex-wrap">
    @foreach ($rewards as $reward)
    @include('components.cards.reward', ['reward' => $reward])
    @endforeach
  </div>
</div>
@endsection