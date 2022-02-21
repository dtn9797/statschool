@extends('layouts.app')

@section('content')
<div class="lg:px-24">
  <h1 class="text-4xl text-gray-800 text-center">Reward Claim</h1>

  <div class="flex justify-center flex-wrap">
    <div class="w-full md:w-1/3">
      @include('components.cards.reward', ['reward' => $reward, 'hide_button' => true])
    </div>
    <div class="w-full md:w-2/3">
      <p class="py-4">
        To claim this reward, make sure you have the necessary score and send an email to <b> statschoolprogram@gmail.com
        </b> with the following content:
      </p>
      <br />
      <p><b>Subject</b></p>
      <p>Claim Reward</p>
      <br />
      <p><b>Body</b></p>
      <p>user: {{Auth::user()->email}} <br /> reward id: {{$reward->id}}</p>
    </div>
  </div>
</div>
@endsection