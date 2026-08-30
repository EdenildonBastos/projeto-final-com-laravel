<x-app-layout>

    <!-- Conteúdo Principal -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <!-- Cabeçalho -->
                <div class="mb-4">
                    <a href="{{ route('books.index') }}" class="text-decoration-none mb-2 d-inline-block">← Voltar para
                        Livros</a>
                    <h1 class="mb-1">Adicionar Novo Livro</h1>
                    <p class="text-white-50 mb-0">Preencha os detalhes para adicionar um livro à sua coleção</p>
                </div>

                <!-- Formulário -->

                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <form method="POST" action="{{ route('books.store') }}" enctype="multipart/form-data">
                            @csrf {{-- diretiva que protege contra ataques maliciosos --}}

                            <!-- Título -->
                            <div class="mb-3 text-white-50 mb-0">
                                <label for="title" class="form-label">Título do Livro <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('title') is-invalid 
                                @enderror"
                                    id="title" name="title" placeholder="Digite o título do livro"
                                    value="{{ old('title') }}">

                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Autor -->
                            <div class="mb-3 text-white-50 mb-0">
                                <label for="author" class="form-label">Autor <span
                                        class="text-danger">*</span></label>
                                <input type="text"
                                    class="form-control @error('author') is-invalid 
                                @enderror"
                                    id="author" name="author" placeholder="Digite o nome do autor"
                                    value="{{ old('author') }}">

                                @error('author')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Capa do Livro -->
                            <div class="mb-3 text-white-50 mb-0">
                                <label for="cover" class="form-label">Capa do Livro<span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                    id="cover" name="cover" accept="image/*">
                                @error('cover')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text text-white-50">IMAGEM JPG ou PNG (máx. 2MB)</div>
                            </div>
                            <!-- Livro -->
                            <div class="mb-3 text-white-50 mb-0">
                                <label for="pdf_file" class="form-label">Arquivo do Livro (PDF)</label>
                                <input type="file" name="pdf_file" id="pdf_file" class="form-control"accept=".pdf,application/pdf">

                                @if (isset($book) && $book->pdf_file)
                                    <small class="text-muted d-block mt-1">
                                        PDF atual cadastrado:
                                        <a href="{{ asset($book->pdf_file) }}" target="_blank">Visualizar PDF</a>
                                    </small>
                                @endif
                                <div class="form-text text-white-50">PDF OPICIONAL DE ATÉ 10MB (10240 KB)</div>
                            </div>
                            
                            <!-- Gênero e Ano de Publicação -->
                            <div class="row mb-3 text-white-50">
                                <!-- CAMPO GÊNERO -->
                                <div class="col-md-6">
                                    <label for="genre_id" class="form-label">Gênero <span
                                            class="text-danger">*</span></label>
                                    <select class="form-select @error('genre_id') is-invalid @enderror" id="genre_id"
                                        name="genre_id">
                                        <option value="">Selecione o Gênero</option>
                                        @foreach ($genres as $genre)
                                            <option value="{{ $genre->id }}"
                                                {{ old('genre_id') == $genre->id ? 'selected' : '' }}>
                                                {{ $genre->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('genre_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- CAMPO ANO DE PUBLICAÇÃO -->
                                <div class="col-md-6">
                                    <label for="published_year" class="form-label">Ano de Publicação <span
                                            class="text-danger">*</span></label>
                                    <input type="number"
                                        class="form-control @error('published_year') is-invalid @enderror"
                                        id="published_year" name="published_year" value="{{ old('published_year') }}"
                                        placeholder="2026">

                                    @error('published_year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <!-- Descrição -->
                            <div class="mb-3 text-white-50 mb-0">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" name="description" rows="5"
                                    placeholder="Digite a descrição do livro...">{{ old('description') }}</textarea>
                            </div>

                            <!-- Botões -->
                            <div class="d-flex gap-3 mt-4">
                                <button type="submit" class="btn btn-primary px-4">Adicionar Livro</button>
                                <a href="{{ route('books.index') }}"
                                    class="btn btn-outline-secondary px-4">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



</x-app-layout>
