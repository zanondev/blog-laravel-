@extends('admin.dashboard.template.base')
@section('content')
    @php $instance_name = "categoria" @endphp
    @csrf
    <div class="default-space-between">

        <h1>Categorias de post</h1>

        <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
            amarelo. Para remover, clique no botão vermelho</p>

        <div class="d-flex">
            <a class="btn-geral btn-green" href="{{ route('post_category.add') }}">Adicionar {{ $instance_name }}</a>
            <button class="btn-geral btn-red btn-multiple-actions remove-multiple-itens ms-2">Excluir</button>
        </div>
        <div class="table-responsive">
            <table class="table nowrap" id="dataTable" data-order='[[0, "desc"]]' width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><b>ID</b></th>
                        <th>Título</th>
                        <th>E-mail</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($post_categories as $post_category)
                        <tr>
                            <td>
                                <div class='option-table-area'>
                                    <input type='checkbox' name='delete-itens[]' class='multiple-delete'
                                        value='{{ $post_category->id }}'>
                                    <div class='checkbox-area'>
                                        <span class='iconify' data-icon='bi:check'></span>
                                    </div>
                                </div>
                            </td>
                            <td><b>{{ $post_category->id }}<b></td>
                            <td>{{ $post_category->title }}</td>
                
                            <td>{{ date('d/m/Y H:i:s', strtotime($post_category->created_at)) }}</td>
                            <td>
                                <div class='d-flex'>
                                    <a href='{{ route('post_category.edit', ['id' => $post_category->id]) }}' class='btn-yellow btn-action'
                                        title='Editar {{ $instance_name }}'>
                                        {!! $pen_iconify !!}
                                    </a>
                                    <button class='btn-red btn-action remove-item' data-value='{{ $post_category->id }}'
                                        title='Excluir {{ $instance_name }}'>
                                        {!! $trash_iconify !!}
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>

    </div>

    <script>
        var url_delete = "{{ route('post_category.delete') }}";
        var url_delete_multiple = "{{ route('post_category.delete_multiple') }}";
        var url_to_redirect = "{{ route('post_category.list') }}"
    </script>
@endsection
