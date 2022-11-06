@extends('admin.dashboard.template.base')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar Categoria</h1>

    <form id="edit-post-category" class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $post_category->id }}">

        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="default-input-group">
                    <label>Título*</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title"
                        maxlength="128" value="{{ $post_category->title }}">
                </div>


            </div>
        </div>


        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>
        </div>

    </form>

    <script>
        var url = "{{ route('post_category.update') }}";
        var url_to_redirect = "{{ route('post_category.list') }}";
    </script>
@endsection
