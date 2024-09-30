@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar Página Sobre</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $page_about->id }}">
        <div class="fields default-space-between form-space">

            <h3>Sobre nós</h3>

            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="title"
                        value="{{ $page_about->title }}">
                </div>
                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="text"
                        name="text">{{ $page_about->text }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Imagem (1920x1080px)</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden" name="image" id="image">
                        @php
                            $class_background = $page_about['image'] != '' ? 'w-background' : '';
                            $style_background = $page_about['image'] != '' ? "style='background-image: url(" . url("/img/uploads/page_about/{$page_about->image}") . ")'" : '';
                        @endphp

                        <div class="preview-img banner {{ $class_background }}" {!! $style_background !!}>
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>
            </div>

            <h3>MSV</h3>
            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título - MSV</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="msv_title"
                        value="{{ $page_about->msv_title }}">
                </div>

                <div class="default-input-group">
                    <label>Missão</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="mission_text"
                        name="mission_text">{{ $page_about->mission_text }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Visão</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="vision_text"
                        name="vision_text">{{ $page_about->vision_text }}</textarea>
                </div>

                <div class="default-input-group">
                    <label>Valores</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="values_text"
                        name="values_text">{{ $page_about->values_text }}</textarea>
                </div>
            </div>

            <h3>História</h3>
            <div class="blue-background default-space-between">
                <div class="default-input-group">
                    <label>Título História</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="history_title"
                        value="{{ $page_about->history_title }}">
                </div>

                <div class="default-input-group">
                    <label>Texto História</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="history_text"
                        name="history_text">{{ $page_about->history_text }}</textarea>
                </div>
            </div>

            <h3>SEO</h3>

            <div class="blue-background default-space-between">
                
                <div class="default-input-group">
                    <label>Título</label>
                    <input class="geral-input required" type="text" placeholder="Digite aqui" name="seo_title" value="{{$page_about->seo_title}}">
                </div>

                <div class="default-input-group">
                    <label>Texto</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="seo_text"
                        name="seo_text">{{$page_about->seo_text}}</textarea>
                </div>

            </div>
            
        </div>


        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('page_about.update') }}";
        var url_to_redirect = "{{ route('page_about.edit') }}";
    </script>
@endsection
