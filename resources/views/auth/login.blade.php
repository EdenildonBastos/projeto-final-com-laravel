<x-guest-layout>
    <div class="login-header">
        <a href="/" class="brand-logo login-logo">
            <span class="logo-icon">⚡</span>
            <span class="logo-text">MeuProjeto</span>
        </a>
        <h2>Acesse sua conta</h2>
        <p>Insira suas credenciais para continuar</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="login-form">
        @csrf

        <!-- Email Address -->
        <div class="form-group">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" class="custom-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" placeholder="seu@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 error-msg" />
        </div>

        <!-- Password -->
        <div class="form-group mt-4">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input id="password" class="custom-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 error-msg" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="form-options mt-4">
            <label for="remember_me" class="remember-label">
                <input id="remember_me" type="checkbox" class="custom-checkbox" name="remember">
                <span>{{ __('Remember me') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="forgot-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="form-actions mt-6">
            <button type="submit" class="btn btn-primary w-full">
                {{ __('Log in') }}
            </button>
        </div>

         <div class="back-home mt-4">
            <a href="{{ route('register') }}" class="btn-secondary-link">
                Não tem uma conta? Registre-se
            </a>
        </div>

        <!-- Back to Home -->
        <div class="back-home mt-4">
            <a href="/" class="btn-secondary-link">← Voltar para a página inicial</a>
        </div>
        
    </form>
</x-guest-layout>