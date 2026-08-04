@auth
    <li class="nav-item dropdown ms-lg-3">
        <!-- Botão com Nome do Usuário -->
        <a class="nav-link dropdown-toggle text-white d-flex align-items-center" 
           href="#" 
           id="userDropdown"
           role="button" 
           data-bs-toggle="dropdown" 
           aria-expanded="false">
            <i class="bi bi-person-circle me-2 fs-5"></i>
            <span>{{ Auth::user()->name }}</span>
        </a>

        <!-- Conteúdo do Dropdown -->
        <div class="dropdown-menu dropdown-menu-end shadow border-0 p-2" aria-labelledby="userDropdown">
            <a class="dropdown-item d-flex align-items-center py-2 px-3 rounded" href="{{ route('profile.edit') }}">
                <i class="bi bi-person me-2 fs-5"></i>
                Perfil
            </a>

            <div class="dropdown-divider my-1"></div>

            <form method="POST" action="{{ route('logout') }}" class="m-0 p-0">
                @csrf
                <button type="submit" class="dropdown-item text-danger d-flex align-items-center py-2 px-3 rounded w-100">
                    <i class="bi bi-box-arrow-right me-2 fs-5"></i>
                    Sair
                </button>
            </form>
        </div>
    </li>
@else
    <li class="nav-item">
        <a class="nav-link text-white" href="{{ route('login') }}">Entrar</a>
    </li>
    @if (Route::has('register'))
        <li class="nav-item">
            <a class="btn btn-outline-light ms-lg-2" href="{{ route('register') }}">Cadastrar</a>
        </li>
    @endif
@endauth
