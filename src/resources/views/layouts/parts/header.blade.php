<!-- header & grobal navi -->

<div id="main_header">
<!-- ヘッダー -->
<nav class="navbar navbar-expand-md navbar-dark shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{route('item.index')}}">
      <img class='navbar-logo' src="{{asset('storage/icon/header-icon.jpeg')}}">
      {{ config('app.name', 'App') }}
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav my-1">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tshirt"></i>商品
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{route('item.index')}}">商品一覧</a>
          <a class="dropdown-item" href="{{route('item.index')}}">未出品商品一覧</a>
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fas fa-tshirt"></i>メーカー
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/admin/maker">メーカー一覧</a>
          </div>
        </li>
      </ul>
    </div>
    <ui class="nav-item dropdown">
      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
          {{ Auth::user()->name }} <span class="caret"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="{{ route('logout') }}"
              onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
              {{ __('Logout') }}
          </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
          </form>
      </div>
    </ui>
  </div>
</nav>
</div>

<script type="text/javascript">
/**
  var base_url = <?php echo json_encode(url('')); ?>;
  $(document).ready(function () {
      Api.init();
  })
*/
</script>