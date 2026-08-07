    <section>
    <header class="mb-4">
        <h3 class="h5 font-weight-bold text-white mb-1">
            {{ __('Informações do Perfil') }}
        </h3>
        <p class="text-muted small">
            {{ __("Atualize as informações do seu perfil e o endereço de e-mail.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Nome -->
        <div class="mb-3 text-white">
            <label for="name" class="form-label">{{ __('Nome') }}</label>
            <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- E-mail -->
        <div class="mb-3 text-white">
            <label for="email" class="form-label">{{ __('E-mail') }}</label>
            <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Botão Salvar -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Salvar') }}</button>

            @if (session('status') === 'profile-updated')
                <span class="text-success small">{{ __('Salvo com sucesso.') }}</span>
            @endif
        </div>
    </form>
</section>

