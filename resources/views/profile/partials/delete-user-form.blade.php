<section>
    <header class="mb-4">
        <h3 class="h5 fw-bold text-danger mb-1">
            {{ __('Excluir Conta') }}
        </h3>
        <p class="text-muted small">
            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Antes de excluir, baixe todos os dados ou informações que deseja reter.') }}
        </p>
    </header>

    <!-- Botão que abre o Modal do Bootstrap -->
    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Excluir Conta') }}
    </button>

    <!-- Modal de Confirmação do Bootstrap 5 -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header">
                        <h5 class="modal-title text-dark fw-bold" id="confirmUserDeletionModalLabel">
                            {{ __('Tem certeza de que deseja excluir sua conta?') }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted small mb-3">
                            {{ __('Depois que sua conta for excluída, todos os seus recursos e dados serão excluídos permanentemente. Digite sua senha para confirmar que deseja excluir permanentemente sua conta.') }}
                        </p>

                        <!-- Input da Senha -->
                        <div class="mb-3">
                            <label for="password" class="form-label sr-only">{{ __('Senha') }}</label>
                            <input 
                                id="password" 
                                name="password" 
                                type="password" 
                                class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                placeholder="{{ __('Senha') }}" 
                            />
                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            {{ __('Cancelar') }}
                        </button>
                        <button type="submit" class="btn btn-danger">
                            {{ __('Excluir Conta') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
