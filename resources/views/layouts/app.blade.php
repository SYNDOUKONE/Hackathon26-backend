<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Hackathon 2026') }}</title>
  <link rel="icon" href="https://sdi-hackathon23.c2e.ci/images/logoSDI-PhotoRoom.png" type="image/icon type">

  <!-- Styles -->
  <link rel="stylesheet" href="{{ mix('css/hackathon-theme.css') }}">
  <link rel="stylesheet" href="{{ mix('css/app.css') }}">

  @livewireStyles

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased" style="min-height:100vh;background:var(--bg-dark);">
  <!-- Background pattern -->
  <div class="hk-grid-bg" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-1" aria-hidden="true"></div>
  <div class="hk-gradient-orb orb-2" aria-hidden="true"></div>

  <x-jet-banner />

  <div style="position:relative;z-index:1;min-height:100vh;display:flex;flex-direction:column;">
    <!-- Navigation -->
    @livewire('navigation-menu')

    <!-- Page Heading -->
    @if(isset($header))
      <header style="background:rgba(10,22,40,0.8);backdrop-filter:blur(20px);border-bottom:1px solid rgba(0,245,255,0.1);padding:0 24px;">
        <div style="max-width:1200px;margin:0 auto;padding:20px 0;">
          {{ $header }}
        </div>
      </header>
    @endif

    <!-- Page Content -->
    <main style="flex:1;position:relative;z-index:1;">
      {{ $slot }}
    </main>
  </div>

  @stack('modals')
  @livewireScripts

  @if(isset($scripts))
    {{ $scripts }}
  @endif
</body>
</html>
