<x-app-layout>
    <!-- Conteúdo Principal -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <!-- Link de Voltar -->
                <a href="{{ route('books.index') }}"
                    class="text-decoration-none mb-4 d-inline-flex align-items-center gap-1 link-primary fw-medium">
                    <span>&larr;</span> Voltar para Livros
                </a>

                <!-- Card de Detalhes do Livro -->
                <div class="card border-0 shadow-sm overflow-hidden">
                    <!-- Cabeçalho com gradiente -->
                    <div class="card-header bg-primary text-white py-4 px-4 border-0">
                        <div class="d-flex justify-content-between align-items-start gap-3">
                            <div>
                                <h1 class="h2 mb-1 fw-bold text-white">{{ $book['title'] }}</h1>
                                <p class="lead mb-0"><span class="text-white">{{ $book['author'] }}</span></p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('books.edit', $book->id) }}"
                                    class="btn btn-success px-4 shadow-sm">Editar</a>

                                <form action="#" method="POST" class="d-inline"
                                    onsubmit="return confirm('Tem certeza que deseja excluir este livro?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Grade de Detalhes -->
                    <div class="card-body p-4">
                        <div class="row g-4">
                            <!-- Coluna Esquerda - Capa -->
                            <div class="col-md-3">
                                <div class="text-center">
                                    @if ($book->cover)
                                        <img src="{{ asset($book->cover) }}" alt="{{ $book->title }}"
                                            class="img-fluid rounded shadow-sm mb-3"
                                            style="max-height: 400px; object-fit: cover;">
                                    @else
                                        <!-- Imagem padrão caso o livro não tenha capa cadastrada -->
                                        <div class="bg-secondary text-white rounded shadow-sm mb-3 d-flex align-items-center justify-content-center"
                                            style="height: 350px;">
                                            <i class="bi bi-book fs-1"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Coluna Direita - Informações -->
                            <div class="col-md-8">
                                <h2 class="h5 mb-3 text-white fw-bold border-bottom pb-2">Informações do Livro</h2>

                                <!-- Card container para envolver a tabela corretamente -->
                                <div class=" shadow-sm border-0 mb-3">
                                    <div class="card-body  p-3">
                                        <div class="border rounded-3 overflow-hidden">
                                            <table class="table table-sm table-borderless align-middle mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td class="text-dark fw-bold pe-3" style="width: 130px;">
                                                            Gênero:
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-3 py-2">
                                                                {{ $book->genre->name ?? 'Não informado' }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-dark fw-bold pe-3" style="width: 130px;">
                                                            Publicado em:
                                                        </td>
                                                        <td class="text-dark fw-semibold">
                                                            {{ $book->published_year }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>

                                {{-- Exibe o PDF --}}
                             <div class="col-md-8 ">
                                <h2 class="h5 mb-3 text-white fw-bold border-bottom pb-2">Ler ou Baixar o PDF</h2>
                              <div>
                                <div class="col-md-4 card border-0 shadow-sm overflow-hidden h-100 ">
                                    @if ($book->pdf_file)
                                        <a href="{{ asset($book->pdf_file) }}" target="_blank"
                                            class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 text-decoration-none text-white bg-danger bg-gradient shadow-sm border border-danger-subtle hover-lift transition-all">
                                            <i class="bi bi-file-earmark-pdf-fill fs-5"></i>
                                            <div class="text-start">
                                                <span class="d-block fw-semibold lh-1"
                                                    style="font-size: 0.85rem;">E-book Disponível</span>
                                                <small class="text-white-50" style="font-size: 0.60rem;">Ler ou Baixar
                                                    PDF</small>
                                            </div>
                                        </a>
                                    @else
                                        <div
                                            class="d-inline-flex align-items-center gap-2 px-3 py-2 rounded-3 bg-dark bg-opacity-50 text-white-50 border border-secondary border-opacity-25">
                                            <i class="bi bi-file-earmark-x fs-5 opacity-50"></i>
                                            <span class="fw-medium" style="font-size: 0.82rem;">Arquivo PDF
                                                indisponível</span>
                                        </div>
                                    @endif
                                </div>
                              </div>
                             </div>

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
                            <a href="{{ route('books.index') }}" class="btn btn-primary px-4 shadow-sm">Voltar para a
                                Lista</a>
                            <a href="{{ route('books.edit', $book->id) }}"
                                class="btn btn-success px-4 shadow-sm">Editar Livro</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
