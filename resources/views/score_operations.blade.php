@extends('layouts.app')

@section('content')
<div class="lg:px-24">
  <h1 class="text-3xl font-bold text-gray-800 text-center py-4">Perform operations of adding or subtracting points from
    a user
  </h1>
  <p class="text-center">
    <a class="text-blue-400 underline" href="/admin">
      Back to administrative panel
    </a>
  </p>
  <div class="max-w-2xl mx-auto">
    <form action="/score-operations" method="post">
      @csrf
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="user">
          Select the user
        </label>
        <select name="user" id="user" required="required" onchange="showUserPoints()"
          class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
          <option value="">Select a user</option>
          @foreach ($users as $user)
          <option value="{{$user->id}}" data-email="{{$user->email}}" data-scoreAmount="{{$user->getScoreAmount()}}">
            {{$user->email}}
          </option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <p class="block text-gray-700 font-bold mb-2 text-lg" id='userScore'>
        </p>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="operation_type">
          Select type of the operation
        </label>
        <select name="operation_type" id="operation_type" required="required"
          class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
          <option value="addition">addition</option>
          <option value="subtraction">subtraction</option>
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="quantity">
          Quantity of points
        </label>
        <input type="number" name="quantity" id="quantity" min="0" step="1" required="required"
          class="shadow appearance-none border border-blue-500 rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
      </div>
      <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Submit
      </button>
    </form>
  </div>
</div>
<script>
function showUserPoints() {
  const p = document.getElementById('userScore')
  const select = document.getElementById('user')
  const selectedOption = select.options[select.selectedIndex]
  const email = selectedOption.getAttribute("data-email")
  const scoreAmount = selectedOption.getAttribute("data-scoreAmount")

  if (email && scoreAmount) {
    p.innerText = `Current Score for ${email}: ${scoreAmount} points`
  } else {
    p.innerText = ''
  }
}
showUserPoints()
</script>
@endsection