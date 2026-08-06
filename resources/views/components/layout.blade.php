{{--Componente Blade para o layout da página inicial do BookCollection.
  Este componente define a estrutura básica da página, incluindo o cabeçalho,
  o conteúdo principal e o rodapé. Ele utiliza Bootstrap 5 para estilização
  e responsividade.--}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">

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

    <!-- CSS Customizado para a página inicial -->
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">

    <!-- Vite Scripts (compilação do Laravel) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-dark d-flex flex-column h-100">

    <!-- Header / Barra de Navegação -->
    <header>
        <nav class="navbar navbar-expand-lg bg-dark navbar-dark border-bottom border-secondary-subtle py-3">
            <div class="container">
                  <i class="bi bi-book me-2 fs-4"></i>
                 <span>BookCollection</span>

                <!-- Botão Hamburger para telas pequenas -->
                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Links e Botões de Autenticação -->
                <div class="collapse navbar-collapse" id="navbarContent">
                    <div class="ms-auto d-flex align-items-center gap-2 mt-3 mt-lg-0">
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm px-3 shadow-sm">Entrar</a>
                        <a href="{{ route('register') }}"
                            class="btn btn-primary btn-sm px-3 shadow-sm">Cadastrar</a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Conteúdo Principal Dinâmico -->
    <main class="flex-shrink-0 my-auto">
        {{ $slot }}
    </main>

    <!-- Rodapé -->
    <footer class="bg-dark text-white-50 py-4 mt-auto border-top border-secondary-subtle">
        <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
            <p class="mb-0 small">&copy; 2026 BookCollection. Todos os direitos reservados.</p>
            <div class="d-flex gap-3">
                <a href="#" class="text-white-50 text-decoration-none small link-light">Privacidade</a>
                <a href="#" class="text-white-50 text-decoration-none small link-light">Termos de Uso</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
