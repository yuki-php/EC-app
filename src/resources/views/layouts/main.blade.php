<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name=”robots” content=”noindex”>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('head_script')
    @yield('css')

    @stack('head')
</head>

<body>
  <!-- ヘッダー -->
  @include('layouts.parts.header')
  <div id="app" class="container-fluid container-large mb-5">
      <!-- サイドバー -->
      <div class="d-none d-md-block col-sm-0 col-md-2">
          @yield('sidebar')
      </div>

      <div id="content">
          <!-- 見出し -->
          @yield('headline')
          <!-- コンテンツ -->
          @yield('content')
      </div>
  </div>
  @yield('foot_script')
</body>

</html>