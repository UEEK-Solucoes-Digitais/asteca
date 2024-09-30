@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Adicionar banner</h1>

    <form id="add-banner" class="default-form geral-form">
        @csrf
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title" maxlength="100">
                </div>

                <div class="geral-grid-div column-2">
                    <div class="default-input-group">
                        <label>Texto do botão</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="btn_text"
                            maxlength="40">
                    </div>
                    <div class="default-input-group">
                        <label>Link do botão</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="btn_link"
                            maxlength="200">
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                        name="text"></textarea>
                </div>

                <div class="default-input-group">
                    <label>Ícone do banner (100x100px SVG)</label>
                    <div class="image-preview  contain">
                        <input type="file" class="input-image-hidden required" name="logo" id="logo">
                        <div class="preview-img icon-preview">
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Imagem (1920x1080px)</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden required" name="image" id="image">
                        <div class="preview-img banner">
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
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
        var url = "{{ route('banner.store') }}";
        var url_to_redirect = "{{ route('banner.list') }}";
    </script>
@endsection
