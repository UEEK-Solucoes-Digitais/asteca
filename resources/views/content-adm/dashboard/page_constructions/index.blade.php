
        @extends("content-adm.dashboard.shared.layout")
        @section("content")
            @php $instance_name = "Pagina De Construcoes" @endphp
            @csrf
            <div class="default-space-between">

                <h1>Pagina De Construcoes</h1>

                <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
                    amarelo. Para remover, clique no botão vermelho</p>

                <div class="d-flex">
                    <a class="btn-geral btn-green" href="{{ route("page_construction.add") }}">
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

                            @foreach ($page_constructions as $page_construction)
                                <tr id="item-{{ $page_construction->id }}">
                                    <td>
                                        <div class="option-table-area">
                                            <input type="checkbox" name="delete-itens[]" class="multiple-delete"
                                                value="{{ $page_construction->id }}">
                                            <div class="checkbox-area">
                                                <iconify-icon icon="bi:check"></iconify-icon>
                                            </div>
                                        </div>
                                    </td>
                                    <td><b>{{ $page_construction->id }}<b></td>
                                    <td>{{ $page_construction->title }}</td>
                                    <td>{{ date("d/m/Y H:i:s", strtotime($page_construction->created_at)) }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route("page_construction.edit", ["id" => $page_construction->id]) }}"
                                                class="btn-yellow btn-action" title="Editar {{ $instance_name }}">
                                                {!! $pen_iconify !!}
                                            </a>
                                            <button class="btn-red btn-action remove-item" data-value="{{ $page_construction->id }}"
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
                var url_organize = "{{ route('page_construction.organize') }}";
                var url_delete = "{{ route('page_construction.delete') }}";
                var url_delete_multiple = "{{ route('page_construction.delete_multiple') }}";
                var url_to_redirect = "{{ route('page_constructions.list') }}"
            </script>
        @endsection
        