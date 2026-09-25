<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Hackathon 2026') }}</title>
  <link rel="icon" href="https://sdi-hackathon23.c2e.ci/images/logoSDI-PhotoRoom.png" type="image/png">

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body style="min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px;">
  <!-- Background -->
  <div class="hk-grid-bg" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

  <div style="position:relative;z-index:1;width:100%;max-width:460px;">
    {{ $slot }}
  </div>
</body>
</html>
