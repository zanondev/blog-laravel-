@extends('Site.template.base')

@section('content')
    <section class="content-wrapper-detail" id="blog-detail">
        <div class="content">
            <div class="text">
            </div>
            <div class="posts-area-detail">
                <div class="geral-list-detail">
                    <a class="post-item" href="javascript:;" title="{{ $post->title }}">
                        <div class="image-detail"
                            style="background: url({{url("img/uploads/posts/{$post->image}")}}) no-repeat center/cover">
                        </div>
                        <div class="post-content">
                            <span class="post-category">{{ $post->category_title }}</span>
                            <h3 class="post-title">{{ $post->title }}</h3>
                            <div class="post-brief-detail">{!! $post->text !!}</div>
                            <div class="image-gallery-detail">
                                <div class="read-more" style="padding-bottom: 25px">
                                    Galeria de Imagens
                                </div>
                            </div>
                            <div class="geral-list">
                                @foreach($post_images as $post_image)
                                <a class="image-item"
                                    href="{{url("img/uploads/post_gallery/{$post_image->image}")}}"
                                    data-fancybox="Galeria de Imagens" title="{{$post_image->alt_text}}">
                                    <img src="{{url("img/uploads/post_gallery/{$post_image->image}")}}" alt="{{$post_image->alt_text}}"> 
                                </a>
                                @endforeach
                            </div>
                            @if (count($related_posts) > 0)
                            <div class="read-more" style="padding-bottom: 25px">
                                Posts Relacionados
                            </div>
                            <div class="geral-list">
                                @foreach ($related_posts as $post)
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
                            @endif
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection
