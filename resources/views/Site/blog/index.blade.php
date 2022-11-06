@extends('Site.template.base')

@section('content')
    <section class="content-wrapper" id="blog-list">
        <div class="content">
            <div class="text">
                <h1>Blog</h1>
                <p>Confira toda a nossa coleção de conteúdo<br>selecionado e disponível neste blog. Se preferir,<br> você
                    pode filtrar os conteúdos por categorias.<br>Boa leitura!</p>
            </div>



            <div class="posts-area">
                <form class="search-blog-form">
                    <input type="text" name="search-input" placeholder="Procurar">
                    <button type="submit" title="Pesquisar">
                        <iconify-icon icon="akar-icons:search"></iconify-icon>
                    </button>
                </form>

                <div class="category-list">
                    <a href="{{ route('site.blog_list') }}" class="btn-category {{ $active_url == 0 ? 'active' : '' }}"
                        title="Todas as categorias">
                        Todas as categorias
                    </a>

                    @foreach ($post_categories as $post_category)
                        <a href="{{ route('site.blog_list_category', ['category_url' => $post_category->url]) }}"
                            class="btn-category {{ $active_url == $post_category->url ? 'active' : '' }}"
                            title="{{ $post_category->title }}">
                            {{ $post_category->title }}
                        </a>
                    @endforeach
                </div>
                
                @if(count($posts) > 0)
                <div class="geral-list">

                    @foreach ($posts as $post)
                        <a class="post-item" href="{{ route('site.blog_detail', ['url' => $post->url]) }}"
                            title="{{ $post->title }}">
                            <div class="image"
                                style="background: url({{ url("img/uploads/posts/{$post->image}") }}) no-repeat center/cover">
                            </div>

                            <div class="post-content">
                                <span class="post-category">{{ $post->category_title }}</span>
                                <h3 class="post-title">{{ $post->title }}</h3>
                                <div class="post-brief">{!! $post->brief !!}</div>
                                <div class="read-more">
                                    Leia mais
                                    <iconify-icon icon="cil:arrow-right"></iconify-icon>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

                <div id="paginate-blog"></div>
                @else
                <p>Nenhum post encontrado..</p>
                @endif
            </div>
        </div>
    </section>

    <script>
        var urlSearch = "{{ route('site.blog_search') }}"
    </script>
@endsection
