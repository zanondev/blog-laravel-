@extends('admin.dashboard.template.base')
@section('content')
    @php $instance_name = "post" @endphp
    @csrf
    <div class="default-space-between">

        <h1>Posts</h1>

        <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
            amarelo. Para remover, clique no botão vermelho</p>

        <div class="d-flex">
            <a class="btn-geral btn-green" href="{{ route('post.add') }}">Adicionar {{ $instance_name }}</a>
            <button class="btn-geral btn-red btn-multiple-actions remove-multiple-itens ms-2">Excluir</button>
        </div>
        <div class="table-responsive">
            <table class="table nowrap" id="dataTable" data-order='[[0, "desc"]]' width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>#</th>
                        <th><b>ID</b></th>
                        <th>Título</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($posts as $post)
                        <tr id="item-{{ $post->id }}">
                            <td>
                                <div class='option-table-area'>
                                    <input type='checkbox' name='delete-itens[]' class='multiple-delete'
                                        value='{{ $post->id }}'>
                                    <div class='checkbox-area'>
                                        <span class='iconify' data-icon='bi:check'></span>
                                    </div>
                                </div>
                            </td>
                            <td><b>{{ $post->id }}<b></td>
                            <td>{{ $post->title }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($post->created_at)) }}</td>
                            <td>
                                <div class='d-flex'>
                                    <a href='{{ route('post.edit', ['id' => $post->id]) }}' class='btn-yellow btn-action'
                                        title='Editar {{ $instance_name }}'>
                                        {!! $pen_iconify !!}
                                    </a>
                                    <a href='{{ route('post_gallery.edit', ['post_id' => $post->id]) }}' class='btn-green btn-action'
                                        title='Editar {{ $instance_name }}'>
                                        {!! $images_iconify !!}
                                    </a>
                                    <button class='btn-red btn-action remove-item' data-value='{{ $post->id }}'
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
        var url_delete = "{{ route('post.delete') }}";
        var url_delete_multiple = "{{ route('post.delete_multiple') }}";
        var url_to_redirect = "{{ route('post.list') }}"
    </script>
@endsection
