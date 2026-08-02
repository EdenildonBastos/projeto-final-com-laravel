            <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo ao Meu Projeto</title>

    <!-- Vinculação do arquivo CSS externo -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fonte Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Header / Barra de Navegação -->
    <header class="navbar">
        <div class="container navbar-container">
            <a href="#" class="brand-logo">
                <span class="logo-icon">⚡</span>
                <span class="logo-text">MeuProjeto</span>
            </a>
            <nav class="nav-links">
                <a href="#features" class="nav-link">Recursos</a>
                <a href="#about" class="nav-link">Sobre</a>
                <a href="#contact" class="nav-link">Contato</a>
            </nav>
            <div class="auth-buttons">
                <a href="/login" class="btn btn-secondary">Entrar</a>
                <a href="/register" class="btn btn-secondary">Cadastrar</a>
            </div>
        </div>
    </header>

    <!-- Rodapé -->
    <footer class="footer">
        <div class="container footer-container">
            <p>&copy; 2026 MeuProjeto. Todos os direitos reservados.</p>
            <div class="footer-links">
                <a href="#">Privacidade</a>
                <a href="#">Termos de Uso</a>
            </div>
        </div>
    </footer>
      {{ $slot }}
</body>
</html>