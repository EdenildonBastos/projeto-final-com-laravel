 {{--Componente Blade para o layout das telas da biblioteca,Este componente define a estrutura básica da página, incluindo o cabeçalho,o conteúdo principal e o rodapé. Ele utiliza Bootstrap 5 para estilização
  e responsividade.--}}
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
       @vite(['resources/css/app.scss', 'resources/js/app.js']);

     <!-- CSS Customizado (Asset local) -->
      <link rel="stylesheet" href="{{ asset('css/book.css') }}"> 

  <body class="bg-light">

      <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm position-relative" style="z-index: 1000;">
          <div class="container">
              <!-- Logo / Marca -->
              <a class="navbar-brand d-flex align-items-center" href="{{ route('dashboard') }}">
                  <i class="bi bi-book me-2 fs-4"></i>
                  Painel de Livros
              </a>

              <!-- Botão Mobile -->
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                  <span class="navbar-toggler-icon" style="filter: invert(36%) sepia(86%) saturate(3500%) hue-rotate(200deg) brightness(98%) contrast(96%);"></span>  <!--muda a cor de dentro do menu hamburguer.-->
                 
              </button>

              <!-- Links da Navbar -->
              <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto align-items-center">
                      <div class="collapse navbar-collapse" id="navbarNav">
                          <ul class="navbar-nav ms-auto align-items-center">
                              <li class="nav-item"><a class="nav-link" href="{{ url('dashboard') }}">Início</a></li>
                              <li class="nav-item"><a class="nav-link" href="{{ url('/livros') }}">Livros</a></li>
                          </ul>
                      </div>

                      @auth
                          <li class="nav-item dropdown ms-lg-3 position-relative">
                              <a class="nav-link dropdown-toggle text-white d-flex align-items-center" href="#"
                                  id="userDropdownNav" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="bi bi-person-circle me-2 fs-5"></i>
                                  <span>{{ Auth::user()->name }}</span>
                              </a>

                              <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2 p-2"
                                  aria-labelledby="userDropdownNav"
                                  style="z-index: 1050 !important; background-color: #ffffff !important;">
                                  <li>
                                      <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded text-dark fw-medium"
                                          href="{{ route('profile.edit') }}">
                                          <i class="bi bi-person me-2 fs-5 text-dark"></i>
                                          <span>Perfil</span>
                                      </a>
                                  </li>
                                  <li>
                                      <hr class="dropdown-divider my-1">
                                  </li>
                                  <li>
                                      <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                                          @csrf
                                          <button type="submit"
                                              class="dropdown-item text-danger d-flex align-items-center py-2 px-3 rounded fw-medium w-100 border-0 bg-transparent">
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
        
      <!-- Rodapé -->
<footer class="bg-dark text-white-50 py-4 mt-auto">
    <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-2">
        <p class="mb-0 small">&copy; 2026 Book-Colletion. Todos os direitos reservados.</p>
        <div class="d-flex gap-3">
            <a href="#" class="text-white-50 text-decoration-none small link-light">Privacidade</a>
            <a href="#" class="text-white-50 text-decoration-none small link-light">Termos de Uso</a>
        </div>
    </div>
</footer>
  </body>

  </html>
