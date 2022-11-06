@extends('admin.dashboard.template.base')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar post</h1>

    <form id="edit-post" class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $post->id }}">
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" maxlength="100"
                        value="{{ $post->title }}">
                </div>

                <div class="default-input-group">
                    <label>Categoria</label>
                    <select class="geral-input required" name="post_category_id">
                        @foreach ($post_categories as $post_category)
                            <option value="{{ $post_category->id }}"
                                {{ $post_category->id == $post->post_category_id ? 'selected' : '' }}>
                                {{ $post_category->title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="default-input-group">
                    <label>Resumo</label>
                    <textarea class="geral-input required " type="text" placeholder="Digite aqui" id="brief"
                        name="brief">{{ $post->brief }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                        name="text">{{ $post->text }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Imagem (1920x1080px)</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden" name="image" id="image">
                        @php
                            $class_background = $post['image'] != '' ? 'w-background' : '';
                            $style_background = $post['image'] != '' ? "style='background-image: url(" . url("/img/uploads/posts/{$post->image}") . ")'" : '';
                        @endphp

                        <div class="preview-img banner {{ $class_background }}" {!! $style_background !!}>
                            <span class="iconify" data-icon="akar-icons:plus"></span>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('post.update') }}";
        var url_to_redirect = "{{ route('post.list') }}";
    </script>
@endsection
