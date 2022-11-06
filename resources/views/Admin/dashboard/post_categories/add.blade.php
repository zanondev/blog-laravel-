@extends('admin.dashboard.template.base')
@section('content')
    <div class="loading-form"></div>

    <h1>Adicionar Categoria</h1>

    <form id="add-post-category" class="default-form geral-form">
        @csrf
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="default-input-group">
                    <label>Título*</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" maxlength="128">
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
        var url = "{{ route('post_category.store') }}";
        var url_to_redirect = "{{ route('post_category.list') }}";
    </script>
@endsection
