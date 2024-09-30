@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar banner</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $banner->id }}">
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title"
                        maxlength="100" value="{{ $banner->title }}">
                </div>

                <div class="geral-grid-div column-2">
                    <div class="default-input-group">
                        <label>Texto do botão</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="btn_text"
                            maxlength="40" value="{{ $banner->btn_text }}">
                    </div>
                    <div class="default-input-group">
                        <label>Link do botão</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="btn_link"
                            maxlength="200" value="{{ $banner->btn_link }}">
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                        name="text">{{ $banner->text }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Ícone do banner (100x100px SVG)</label>
                    <div class="image-preview ">
                        <input type="file" class="input-image-hidden" name="logo" id="logo">
                        @php
                            $class_background = $banner['logo'] != '' ? 'w-background' : '';
                            $style_background = $banner['logo'] != '' ? "style='background-image: url(" . url("/img/uploads/banners/{$banner->logo}") . ")'" : '';
                        @endphp

                        <div class="preview-img icon-preview {{ $class_background }}" {!! $style_background !!}>
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Imagem (1920x1080px)</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden" name="image" id="image">
                        @php
                            $class_background = $banner['image'] != '' ? 'w-background' : '';
                            $style_background = $banner['image'] != '' ? "style='background-image: url(" . url("/img/uploads/banners/{$banner->image}") . ")'" : '';
                        @endphp

                        <div class="preview-img banner {{ $class_background }}" {!! $style_background !!}>
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
        var url = "{{ route('banner.update') }}";
        var url_to_redirect = "{{ route('banner.list') }}";
    </script>
@endsection
