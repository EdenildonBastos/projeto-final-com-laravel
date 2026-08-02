<x-guest-layout>
    <div class="login-header">
        <a href="/" class="brand-logo login-logo">
            <span class="logo-icon">⚡</span>
            <span class="logo-text">MeuProjeto</span>
        </a>
        <h2>Crie sua conta</h2>
        <p>Preencha os dados abaixo para começar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="login-form">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" class="custom-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" placeholder="Seu nome completo" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 error-msg" />
        </div>

        <!-- Email Address -->
        <div class="form-group mt-4">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="custom-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 error-msg" />
        </div>

        <!-- Password -->
        <div class="form-group mt-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="custom-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 error-msg" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group mt-4">
            <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" class="custom-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 error-msg" />
        </div>

        <!-- Submit Button -->
        <div class="form-actions mt-6">
            <button type="submit" class="btn btn-primary w-full">
                Cadastrar
            </button>
        </div>

        <!-- Back to Login -->
        <div class="back-home mt-4">
            <a href="{{ route('login') }}" class="btn-secondary-link">
                Já tem uma conta? Entrar
            </a>
        </div>
        <!-- Back to Home -->
        <div class="back-home mt-4">
            <a href="/" class="btn-secondary-link">← Voltar para a página inicial</a>
        </div>
    </form>
</x-guest-layout>
