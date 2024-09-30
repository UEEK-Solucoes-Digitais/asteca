@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Adicionar Lancamentos</h1>

    <form class="default-form geral-form">
        @csrf
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Título</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" value="">
                    </div>

                    <div class="default-input-group">
                        <label>Subtítulo</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="subtitle" value="">
                    </div>

                </div>

                <div class="default-input-group">
                    <label>Descrição</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="description"
                        name="description"></textarea>
                </div>

                <div class="geral-grid-div column-4">

                    <div class="default-input-group">
                        <label>Porcentagem</label>
                        <input class="geral-input required" type="number" min=0 max=100 placeholder="Digite aqui"
                            maxlength="3" name="percentage_done" value="">
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
                        <label>Data inicial</label>
                        <input class="geral-input required" type="date" placeholder="Digite aqui" name="initial_date"
                            value="">
                    </div>

                    <div class="default-input-group">
                        <label>Data final</label>
                        <input class="geral-input required" type="date" placeholder="Digite aqui" name="final_date"
                            value="">
                    </div>

                </div>

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Endereço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="address">
                    </div>
                    <div class="default-input-group">
                        <label>Área</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="area">
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Imagem</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden required" name="image" id="image">

                        <div class="preview-img">
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Arraste o marcador no mapa para selecionar o local desta propriedade</label>
                    <input type="hidden" class="form-control" id="latitude" name="latitude" value="-27" />
                    <input type="hidden" class="form-control" id="longitude" name="longitude" value="-50" />
                    <div id="crud-map" style="height: 400px;"></div>
                </div>



                <div class="geral-grid-div column-2">

                    <div class="differentials default-space-between">

                        <div class="default-input-group">
                            <label>Diferencial</label>

                            <input class="geral-input" placeholder="Exemplo: Portaria 24hs;" type="text"
                                name="differentials[]" maxlength="150">
                        </div>

                        <div class="buttons d-flex">

                            <button type="button" class="btn-action btn-green plus-item" data-value='differentials'>
                                <iconify-icon icon="akar-icons:plus"></iconify-icon>
                            </button>
                            <button type="button" class="btn-action btn-red less-item" data-value='differentials' hidden>
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
        var url = "{{ route('our_release.store') }}";
        var url_to_redirect = "{{ route('our_releases.list') }}";
    </script>
@endsection
