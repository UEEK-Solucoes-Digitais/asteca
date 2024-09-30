@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Adicionar Propriedades</h1>

    <form class="default-form geral-form">
        @csrf
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="default-input-group">
                    <label>Imagem</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden required" name="image" id="image">

                        <div class="preview-img">
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Descrição</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="description"
                        name="description"></textarea>
                </div>

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Título</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="title">
                    </div>

                    <div class="default-input-group">
                        <label>Endereço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="address">
                    </div>

                </div>

                <div class="geral-grid-div column-4">

                    <div class="default-input-group">
                        <label>WhatsApp</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="whatsapp"
                            onkeydown="Mascara(this, Telefone)" maxlength="15">
                    </div>

                    <div class="default-input-group">
                        <label>Área</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="area">
                    </div>

                    <div class="default-input-group">
                        <label>Tipo do imóvel</label>
                        <select class="geral-input required" name="property_type_id">
                            @foreach ($property_types as $property_type)
                                <option value="{{ $property_type->id }}">{{ $property_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="default-input-group">
                        <label>Preço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="price"
                            onkeydown="Mascara(this, Valor)">
                    </div>

                </div>

                <div class="geral-grid-div column-2">

                    <div class="infos default-space-between">

                        <div class="default-input-group">

                            <label>Informações adicionais</label>

                            <input class="geral-input" placeholder="Título" type="text" name="infos_title[]"
                                maxlength="150">
                            <input class="geral-input" placeholder="Valor" type="text" name="infos_value[]"
                                onkeydown="Mascara(this, Valor)">

                        </div>

                        <div class="buttons d-flex">

                            <button type="button" class="btn-action btn-green plus-item" data-value='infos'>
                                <iconify-icon icon="akar-icons:plus"></iconify-icon>
                            </button>
                            <button type="button" class="btn-action btn-red less-item" data-value='infos' hidden>
                                <iconify-icon icon="akar-icons:minus"></iconify-icon>
                            </button>

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
        var url = "{{ route('property.store') }}";
        var url_to_redirect = "{{ route('property.list') }}";
    </script>
@endsection
