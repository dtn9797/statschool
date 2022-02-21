<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Scripts -->
  <script src="{{ asset('js/app.js') }}" defer></script>

  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
  <style>
  .bg-polar {
    background-color: #E5F4FA
  }
  </style>
</head>

<body class="bg-polar">
  <div class="flex justify-center w-full mb-12 lg:mb-32">
    <img src="{{ asset('images/logo.png') }}" alt="" class="w-32 lg:w-64">
  </div>
  <div class="flex justify-center w-full mb-12">
    <div class="w-full lg:w-1/2 bg-white p-6 lg:p-12 rounded-md">
      @include('contact.form')
    </div>
  </div>
</body>

</html>
