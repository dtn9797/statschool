<div class="w-full lg:max-w-3xl flex flex-wrap bg-gray-200 p-4 mb-4 rounded-lg">
  <div class="w-full md:w-2/12">
    <img src="{{ $offer['picture'] }}" alt="" class="w-full rounded-sm">
  </div>
  <div class="w-full md:w-7/12 px-2">
    <p class="text-xl font-bold text-gray-800">{{ $offer['name_short'] }}</p>
    <p class="text-lg text-gray-600">{{ $offer['adcopy'] }}</p>
  </div>
  <div class="w-full md:w-3/12 flex items-center">
    <a href="{{ $offer['link'] }}" target="_blank" rel="noopener noreferrer"
      class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-2">
      + {{ $offer['payout'] * 100 }} points
    </a>
  </div>
</div>