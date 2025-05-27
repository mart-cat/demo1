<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Мой Не Сам')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
  <div class="container">
    <a class="navbar-brand fw-bold" href="/">Мой Не Сам</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNavbar">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @guest
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{ route('orders.index') }}">Мои заявки</a>
            </li>
            @if(Auth::user()->role->name === 'admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.index') }}">Админ-панель</a>
                </li>
            @endif
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-outline-danger btn-sm ms-2">Выйти</button>
                </form>
            </li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

    <div class="main-container container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
