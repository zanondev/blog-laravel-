<header>
    <div class="background"></div>
    <div class="content-wrapper">
        <nav class="geral-nav">
            <a href="{{ route('site.blog_list') }}" title="Link para listagem do blog" class="geral-logo">
                <img src="{{ url('img/logo.svg') }}" alt="Logo UEEK connect">
            </a>

            <ul class="nav-links">

                <li class="nav-link-item">
                    <div class="nav-link with-sublinks" title="Categoria">
                        Categorias
                        <iconify-icon icon="akar-icons:chevron-down"></iconify-icon>

                        <div class="sublinks">
                            <ul class="sublinks-list">
                                @foreach ($post_categories as $post_category)
                                    <li>
                                        <a href="{{ route('site.blog_list_category', ['category_url' => $post_category->url]) }}"
                                            class="sublink-item" title="{{$post_category->title}}">
                                            {{$post_category->title}}
                                        </a>
                                    </li>
                                @endforeach


                            </ul>
                        </div>
                    </div>
                </li>

                <li class="nav-link-item">
                    <a href="mailto: szanonn@gmail.com" class="nav-link" title="szanonn@gmail.com">
                        <iconify-icon icon="ic:round-alternate-email"></iconify-icon>
                        szanonn@gmail.com
                    </a>
                </li>

                <li class="nav-link-item">
                    <a href="tel: (21) 97616-5435" class="nav-link" title="(21) 97616-5435">
                        <iconify-icon icon="carbon:phone"></iconify-icon>
                        (21) 97616-5435
                    </a>
                </li>

                <li class="nav-link-item">
                    <a href="https://pt-br.facebook.com" class="nav-link" title="https://pt-br.facebook.com">
                        <iconify-icon icon="jam:facebook-circle"></iconify-icon>
                    </a>
                </li>

                <li class="nav-link-item">
                    <a href="https://www.linkedin.com/in/lucaszanon/" class="nav-link"
                        title="https://www.linkedin.com/in/lucaszanon/">
                        <iconify-icon icon="lucide:linkedin"></iconify-icon>
                    </a>
                </li>

            </ul>

            <button class="nav-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </nav>
    </div>
</header>
