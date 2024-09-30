@extends('content-adm.dashboard.shared.layout')
@section('content')
    @php $instance_name = "Lancamentos" @endphp
    @csrf
    <div class="default-space-between">

        <h1>Lancamentos</h1>

        <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
            amarelo. Para remover, clique no botão vermelho</p>

        <div class="d-flex">
            <a class="btn-geral btn-green" href="{{ route('our_release.add') }}">
                <iconify-icon icon="akar-icons:plus"></iconify-icon>
                Adicionar {{ $instance_name }}
            </a>
            <button class="btn-geral btn-blue btn-multiple-actions copy-multiple-itens ms-2">
                <iconify-icon icon="akar-icons:copy"></iconify-icon>
                Copiar
            </button>
            <button class="btn-geral btn-red btn-multiple-actions remove-multiple-itens ms-2">
                <iconify-icon icon="ci:trash-empty"></iconify-icon>
                Excluir
            </button>
        </div>
        <div class="table-responsive">
            <table class="table nowrap" id="dataTable" data-order='[[0, "desc"]]' width="100%" cellspacing="0">

                <thead>
                    <tr>
                        <th>
                            <div class="option-table-area">
                                <input type="checkbox" name="select-all" class="multiple-delete">
                                <div class="checkbox-area">
                                    <iconify-icon icon="bi:check"></iconify-icon>
                                </div>
                            </div>
                        </th>
                        <th><b>ID</b></th>
                        <th>title</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody class="tdbody-to-sortable">

                    @foreach ($our_releases as $our_release)
                        <tr id="item-{{ $our_release->id }}">
                            <td>
                                <div class="option-table-area">
                                    <input type="checkbox" name="delete-itens[]" class="multiple-delete"
                                        value="{{ $our_release->id }}">
                                    <div class="checkbox-area">
                                        <iconify-icon icon="bi:check"></iconify-icon>
                                    </div>
                                </div>
                            </td>
                            <td><b>{{ $our_release->id }}<b></td>
                            <td>{{ $our_release->title }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($our_release->created_at)) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('our_release.edit', ['id' => $our_release->id]) }}"
                                        class="btn-yellow btn-action" title="Editar {{ $instance_name }}">
                                        {!! $pen_iconify !!}
                                    </a>
                                    <a href="{{ route('gallery.edit', ['type' => 2, 'item_id' => $our_release->id]) }}"
                                        class="btn-green btn-action" title="Editar {{ $instance_name }}">
                                        {!! $images_iconify !!}
                                    </a>
                                    <a href="{{ route('unity.list', ['release_id' => $our_release->id]) }}"
                                        class="btn-purple btn-action"
                                        title="Unidades do lançamento - {{ $instance_name }}">
                                        <iconify-icon icon="bx:buildings"></iconify-icon>
                                    </a>
                                    <button class="btn-red btn-action remove-item" data-value="{{ $our_release->id }}"
                                        title="Excluir {{ $instance_name }}">
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
        var url_organize = "{{ route('our_release.organize') }}";
        var url_delete = "{{ route('our_release.delete') }}";
        var url_delete_multiple = "{{ route('our_release.delete_multiple') }}";
        var url_to_redirect = "{{ route('our_releases.list') }}"
        var url_copy = "{{ route('our_release.copy') }}"
    </script>
@endsection
