@extends('layouts.app')
@section('content')
<script>
function showHomeLink(){
    document.getElementById('link_to_insta').style = 'display:none';
    document.getElementById('link_to_home').style = 'display:flex';
}
</script>
<div class="lg:px-24">
  <div class="w-full flex justify-center">
    <div class="bg-grey-100 my-24">
      <p class="text-3xl mb-12 max-w-6xl">
        Click The Instagram Button Below To Follow
        <a href="https://www.instagram.com/statschool/" target="_blank" rel="noopener noreferrer" class="text-blue-500">
          @statschool
        </a> To Move Forward
      </p>
      <div class="max-w-sm mx-auto mb-8" id="link_to_insta" onclick="showHomeLink()">
        <a href="https://www.instagram.com/statschool/" target="_blank" rel="noopener noreferrer">
          <img src="{{ asset('images/instagram.png') }}" alt="instagram logo" class="w-full">
        </a>
      </div>
      <div class="max-w-sm flex mx-auto justify-center" id="link_to_home" style="display:none">
        <a href="/" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded my-2">
          OK
        </a>
      </div>
    </div>
  </div>
</div>
@endsection
