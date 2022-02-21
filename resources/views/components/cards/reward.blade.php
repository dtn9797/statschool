<div class="w-full md:w-64 rounded overflow-hidden shadow-2xl mx-4 py-2">
  <img class="w-48 mx-auto rounded-lg" src="{{Voyager::image($reward->image)}}" alt="{{$reward->title}}">
  <div class="px-6 py-4">
    <div class="font-bold text-xl mb-2">{{$reward->title}}</div>
    {!!$reward->description!!}
    <p class="font-bold mt-4">Price: {{$reward->price}}</p>
  </div>
  @unless ($hide_button ?? '')
  <div class="px-6 py-4 flex justify-center">
    <a href="/reward/{{$reward->id}}/claim"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
      Claim
    </a>
  </div>
  @endunless
</div>