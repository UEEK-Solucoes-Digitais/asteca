@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <!-- Page Heading -->

    <h1>Editar galeria</h1>

    <p>
        Os campos que são gerados ao adicionar imagens são os textos alternativos de cada uma.<br>
        O texto alternativo é exibido no lugar da imagem caso ela não seja carregada, ou o usuário<br>
        utilize um leitor de tela.
    </p>

    <form id="edit-gallery"class="default-form edit-gallery geral-gallery-form">
        @csrf
        <div class="fields default-space-between form-space">
            <div class="default-input-group">
                <div class="d-flex align-items-center">
                    <label>Imagens</label>
                </div>
                <div class="image-preview">
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="item_id" value="{{ $item_id }}">
                    <input type="file" class="input-image-hidden required" name="images" id="images" multiple>

                    <div class="geral-grid-div column-2 images-to-add">

                        <div class="preview-img gallery div-to-add">

                            <iconify-icon icon="akar-icons:plus"></iconify-icon>


                            <div class="alt-text" hidden>
                                <input type="text" class="input-alt-text" name="image_alt[]">
                            </div>

                        </div>

                    </div>
                </div>


            </div>

            <div class="d-flex align-items-center">

                <h3 class='mr-2'>Imagens adicionadas</h3>

            </div>

            <div class="image-preview geral-grid-div column-2" id="image-list">

                @foreach ($images as $image)
                    @php
                        $class_background = $image['image'] != '' ? 'w-background' : '';
                    
                        if ($image['image'] != '') {
                            $image_url = $image['is_from_api'] == 1 ? $image['image'] : '/img/uploads/gallery/' . $image['image'];
                            $style_background = "style='background-image: url({$image_url})'";
                        } else {
                            $style_background = '';
                        }
                    @endphp
                    <div class='image-item' id='item-{{ $image['id'] }}'>
                        <a class='preview-img gallery {{ $class_background }}' {!! $style_background !!}
                            data-fancybox='galeria-sobre-nos' href='/img/uploads/gallery/{{ $image['image'] }}'>

                            <span class='iconify' data-icon='akar-icons:plus'></span>

                        </a>

                        <div class='alt-text'>
                            <input class='input-alt-text input_image_alt alt' type='text'
                                value='{{ $image['alt_text'] }}' name='image_alt{{ $image['id'] }}'>
                        </div>

                        <input type='hidden' class='id' value='{{ $image['id'] }}'>

                        <button type='button' class='btn-red btn-action remove-gallery-image'
                            data-value='{{ $image['id'] }}'>
                            {!! $trash_iconify !!}
                        </button>
                    </div>
                @endforeach

            </div>

            <div class="actions d-flex">
                <button type="button" class="btn-geral btn-green me-2" onclick="window.history.go(-1)">Voltar</button>
                <input type="submit" class="btn-geral" value="Enviar">
            </div>
        </div>

    </form>
@endsection
<script>
    var url = "{{ route('gallery.update') }}"
    var url_update = "{{ route('gallery.updateAlt') }}"
    var url_delete = "{{ route('gallery.delete') }}"
    var url_organize = "{{ route('gallery.organize') }}"
</script>
