<x-app-layout>
    <!-- Adicionada min-vh-100 para forçar a altura mínima da tela -->
    <div class="container py-5 min-vh-100 d-flex flex-column justify-content-between">

        <!-- Conteúdo Superior (Cabeçalho + Tabela + Paginação) -->
        <div>
            <!-- Cabeçalho -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h1 class="h2 mb-1 text-white fw-bold">Coleção de Livros</h1>
                    <p class="text-white-50 mb-0">Gerencie sua biblioteca de livros</p>
                </div>
                <a href="{{ route('books.create') }}"
                    class="btn btn-primary d-inline-flex align-items-center gap-2 shadow-sm">
                    <span>+</span> Adicionar Novo Livro
                </a>
            </div>

            <!-- Tabela de Livros -->
            <div class="card border-0 shadow-sm overflow-hidden">
                <div class="table-responsive ">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th scope="col" class="ps-4">Livro</th>
                                <th scope="col">Autor</th>
                                <th scope="col">Gênero</th>
                                <th scope="col">Publicação</th>
                                <th scope="col" class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($books as $book)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-semibold text-dark">{{ $book['title'] }}</div>
                                    </td>
                                    <td>{{ $book['author'] }}</td>
                                    <td>
                                        <span
                                            class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3">
                                            {{ $book['genre']['name'] }}
                                        </span>
                                    </td>
                                    <td class="text-secondary">{{ $book->published_year }}</td>
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Ações do Livro">
                                            <a href="{{ route('books.show', $book['id']) }}"
                                                class="btn btn-outline-secondary">Ver</a>
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="btn btn-outline-success">Editar</a>
                                            {{-- Formulário de exclusão para métodos HTTP seguros --}}
                                            <form method="POST" action="{{ route('books.destroy', $book->id) }}"
                                                class="d-inline"
                                                onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-outline-danger border-start-0 rounded-end">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                        <!-- Area da paginação integrada ao card com fundo branco -->
                        <div class="d-flex justify-content-end align-items-center bg-white p-3 border-top ">
                            {{ $books->links() }}
                        </div>
                    
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
