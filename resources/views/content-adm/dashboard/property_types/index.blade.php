@extends('content-adm.dashboard.shared.layout')
@section('content')
    @php $instance_name = "tipo de imóvel" @endphp
    @csrf
    <div class="default-space-between">

        <h1>Tipo de imóvel</h1>

        <p><b>Todos os dados cadastrados pelo gestor são exibidos aqui.</b> Para editar as informações, clique no botão
            amarelo. Para remover, clique no botão vermelho</p>

        <div class="d-flex">
            <a class="btn-geral btn-green" href="{{ route('property_type.add') }}">
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
                        <th>Nome</th>
                        <th>Criado em</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody class="tdbody-to-sortable">

                    @foreach ($property_types as $property_type)
                        <tr id="item-{{ $property_type->id }}">
                            <td>
                                <div class="option-table-area">
                                    <input type="checkbox" name="delete-itens[]" class="multiple-delete"
                                        value="{{ $property_type->id }}">
                                    <div class="checkbox-area">
                                        <iconify-icon icon="bi:check"></iconify-icon>
                                    </div>
                                </div>
                            </td>
                            <td><b>{{ $property_type->id }}<b></td>
                            <td>{{ $property_type->name }}</td>
                            <td>{{ date('d/m/Y H:i:s', strtotime($property_type->created_at)) }}</td>
                            <td>
                                <div class="d-flex">
                                    <a href="{{ route('property_type.edit', ['id' => $property_type->id]) }}"
                                        class="btn-yellow btn-action" title="Editar {{ $instance_name }}">
                                        {!! $pen_iconify !!}
                                    </a>
                                    <button class="btn-red btn-action remove-item" data-value="{{ $property_type->id }}"
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
        var url_copy = "{{ route('property_type.copy') }}";
        var url_organize = "{{ route('property_type.organize') }}";
        var url_delete = "{{ route('property_type.delete') }}";
        var url_delete_multiple = "{{ route('property_type.delete_multiple') }}";
        var url_to_redirect = "{{ route('property_type.list') }}"
    </script>
@endsection
