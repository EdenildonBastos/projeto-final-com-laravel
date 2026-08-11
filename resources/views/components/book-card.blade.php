@props(['book' =>[]
])




<div {{$attributes-> merge(['class' => 'card h-100'])}}>
    <img src="https://placehold.co/400x300/6c757d/ffffff?text=Capa+do+Livro" alt="Capa do Livros" class="card-img-top text-muted"
        style="height: 200px; object-fit: cover;">
    <div class="card-body">
        <h5 class="card-title">{{ $book['title'] }}</h5>
        <p class="text-muted mb-2">{{ $book['author'] }}</p>
        <p class="small text-muted mb-3">publicado:{{ $book['published_year'] }}</p>
        <a href="{{ route('books.show', ['book' => $book['id']]) }}" class="card-link">Ver Detalhes →</a>
    </div>
</div>
