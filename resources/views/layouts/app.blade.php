  <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Painel de Livros') }}</title>

    <!-- Fontes -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS & Ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- CSS Customizado (Asset local) -->
    <link rel="stylesheet" href="{{ asset('css/book.css') }}">

    <!-- Vite Scripts (compilação do Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

 <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm position-relative" style="z-index: 1000;">
    <div class="container">
        <!-- Logo / Marca -->
        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
            <i class="bi bi-book me-2 fs-4"></i>
            Painel de Livros
        </a>

        <!-- Botão Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Links da Navbar -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
               <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Início</a></li>
        <li class="nav-item"><a class="nav-link" href="{{ url('/livros') }}">Livros</a></li>
    </ul>
</div>

                @auth
                    <li class="nav-item dropdown ms-lg-3 position-relative">
                        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" 
                           href="#" 
                           id="userDropdownNav" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="bi bi-person-circle me-2 fs-5"></i>
                            <span>{{ Auth::user()->name }}</span>
                        </a>
                        
                        <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2" 
                            aria-labelledby="userDropdownNav"
                            style="z-index: 1050 !important; background-color: #ffffff !important;">
                            <li>
                                <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded text-dark fw-medium" href="{{ route('profile.edit') }}">
                                    <i class="bi bi-person me-2 fs-5 text-dark"></i>
                                    <span>Perfil</span>
                                </a>
                            </li>
                            <li><hr class="dropdown-divider my-1"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 px-3 rounded fw-medium w-100 border-0 bg-transparent">
                                        <i class="bi bi-box-arrow-right me-2 fs-5 text-danger"></i>
                                        <span>Sair</span>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('login') }}">Entrar</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

    <!-- Cabeçalho Dinâmico -->
    @isset($header)
        <header class="bg-white shadow-sm mb-4">
            <div class="container py-3">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Conteúdo Principal Dinâmico -->
    <main class="container my-4">
        {{ $slot }}
    </main>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>