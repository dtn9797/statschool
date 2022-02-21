<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
  @csrf
</form>
<script>
function logout() {
  document.getElementById('logout-form').submit();
}
</script>

<nav class="flex items-center justify-between flex-wrap bg-stat-school p-2 lg:px-24">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <a href="/">
      <img src="{{ asset('images/logo.png') }}" alt="" class="w-32">
    </a>
  </div>
  <div class="w-full block lg:flex lg:items-end lg:w-auto">
    <div class="text-sm lg:flex-grow">
      <a href="/"
        class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-gray-700 text-lg font-bold mr-4 cursor-pointer">
        Offers
      </a>
      <a href="/rewards"
        class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-gray-700 text-lg font-bold mr-4 cursor-pointer">
        Rewards
      </a>
      @guest
      <a href="{{ route('login') }}"
        class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-gray-700 text-lg font-bold mr-4 cursor-pointer">
        {{ __('Login') }}
      </a>
      @if (Route::has('register'))
      <a href="{{ route('register') }}"
        class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-gray-700 text-lg font-bold mr-4 cursor-pointer">
        {{ __('Register') }}
      </a>
      @endif
      @else
      <a onclick="logout()"
        class="block mt-4 lg:inline-block lg:mt-0 text-black hover:text-gray-700 text-lg font-bold mr-4 cursor-pointer">
        {{ __('Logout') }}
      </a>
      @endguest
    </div>
  </div>
</nav>
@auth
<p class="lg:px-24 py-4 bg-gray-300 text-2xl">
  Total Points: {{Auth::user()->getScoreAmount()}}
</p>
@endauth