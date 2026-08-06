<x-app-layout>
    <!-- Conteúdo Principal -->
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Link de Voltar -->
            <a href="{{ route('books.index') }}" class="text-decoration-none mb-4 d-inline-flex align-items-center gap-1 link-primary fw-medium">
                <span>&larr;</span> Voltar para Livros
            </a>

            <!-- Card de Detalhes do Livro -->
            <div class="card border-0 shadow-sm overflow-hidden">
                <!-- Cabeçalho com gradiente -->
                <div class="card-header bg-primary text-white py-4 px-4 border-0">
                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <h1 class="h2 mb-1 fw-bold text-white">{{ $book['title'] }}</h1>
                            <p class="lead mb-0 text-white-50">{{ $book['author'] }}</p>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-success px-4 shadow-sm">Editar</a>
                            
                            <form action="#" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                @csrf
                                @method('DELETE')
                                {{-- <button type="submit" class="btn btn-danger btn-sm  shadow-sm"></button> --}}
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Grade de Detalhes -->
                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- Coluna Esquerda - Capa -->
                        <div class="col-md-4">
                            <div class="text-center">
                                <img src="https://placehold.co/300x450/6c757d/ffffff?text=Capa+do+Livro" alt="Capa do Livro" class="img-fluid rounded shadow-sm mb-3" style="max-height: 400px;">
                            </div>
                        </div>

                        <!-- Coluna Direita - Informações -->
                        <div class="col-md-8">
                            <h2 class="h5 mb-3 text-white fw-bold border-bottom pb-2">Informações do Livro</h2>
                          
                            <table class="table table-sm table-borderless align-middle card border-1">
                                
                                <tbody>
                                    <tr>
                                        <td class="text-dark fw-bold fw-medium pe-3" style="width: 120px;">Gênero:</td>
                                        <td>
                                            <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2">
                                                {{ $book['genre'] }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-dark fw-bold fw-medium pe-3">Publicado:</td>
                                        <td class="text-dark fw-semibold">{{ $book['published_year'] }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Descrição -->
                        <div class="col-12">
                            <h2 class="h5 mb-2 text-white fw-bold border-bottom pb-2">Sobre Este Livro</h2>
                            <p class="text-secondary lh-base mb-0">
                                {{ $book['description'] }}
                            </p>
                        </div>
                    </div>

                    <!-- Botões de Ação -->
                    <div class="mt-4 pt-3 border-top d-flex gap-2">
                        <a href="{{ route('books.index') }}" class="btn btn-primary px-4 shadow-sm">Voltar para a Lista</a>
                        <a href="#" class="btn btn-success px-4 shadow-sm">Editar Livro</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
</x-app-layout>

