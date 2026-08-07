    <section>
    <header class="mb-4">
        <h3 class="h5 fw-bold text-white mb-1">
            {{ __('Atualizar Senha') }}
        </h3>
        <p class="text-muted small">
            {{ __('Certifique-se de que sua conta esteja usando uma senha longa e aleatória para se manter segura.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Senha Atual -->
        <div class="mb-3 text-white">
            <label for="update_password_current_password" class="form-label">{{ __('Senha Atual') }}</label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                autocomplete="current-password" 
            />
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Nova Senha -->
        <div class="mb-3 text-white">
            <label for="update_password_password" class="form-label">{{ __('Nova Senha') }}</label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                autocomplete="new-password" 
            />
            @error('password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirmar Senha -->
        <div class="mb-3 text-white">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmar Senha') }}</label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                autocomplete="new-password" 
            />
            @error('password_confirmation', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botão Salvar e Status -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>

            @if (session('status') === 'password-updated')
                <span class="text-success small">{{ __('Salvo com sucesso.') }}</span>
            @endif
        </div>
    </form>
</section>