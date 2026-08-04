<x-app-layout>
    <!-- Cabeçalho do Perfil -->
    <x-slot name="header">
        <h2 class="h4 text-dark mb-0 fw-bold">
            <i class="bi bi-person-gear me-2"></i>{{ __('Meu Perfil') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center g-4">
        <div class="col-12 col-md-10 col-lg-8">
            
            <!-- 1. Atualizar Informações do Perfil -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- 2. Atualizar Senha -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- 3. Excluir Conta -->
            <div class="card shadow-sm border-0 mb-4 border-start border-danger border-4">
                <div class="card-body p-4">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>