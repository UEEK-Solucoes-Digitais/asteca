@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar Lancamentos</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value="{{ $our_release->id }}">
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Título</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="title"
                            value="{{ $our_release->title }}">
                    </div>

                    <div class="default-input-group">
                        <label>Subtítulo</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="subtitle"
                            value="{{ $our_release->subtitle }}">
                    </div>

                </div>

                <div class="default-input-group">
                    <label>Descrição</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="description"
                        name="description">{{ $our_release->description }}</textarea>
                </div>

                <div class="geral-grid-div column-4">

                    <div class="default-input-group">
                        <label>Porcentagem</label>
                        <input class="geral-input required" type="number" placeholder="Digite aqui" name="percentage_done"
                            value="{{ $our_release->percentage_done }}">
                    </div>

                    <div class="default-input-group">
                        <label>Tipo do imóvel</label>
                        <select class="geral-input required" name="property_type_id">
                            @foreach ($property_types as $property_type)
                                <option value="{{ $property_type->id }}"
                                    {{ $property_type->id == $our_release->property_type_id ? ' selected' : '' }}>
                                    {{ $property_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="default-input-group">
                        <label>Data inicial</label>
                        <input class="geral-input required" type="date" placeholder="Digite aqui" name="initial_date"
                            value="{{ $our_release->initial_date }}">
                    </div>

                    <div class="default-input-group">
                        <label>Data final</label>
                        <input class="geral-input required" type="date" placeholder="Digite aqui" name="final_date"
                            value="{{ $our_release->final_date }}">
                    </div>

                </div>

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Endereço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="address"
                            value="{{ $our_release->address }}">
                    </div>
                    <div class="default-input-group">
                        <label>Área</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="area"
                            value="{{ $our_release->area }}">
                    </div>
                </div>

                <div class="default-input-group">
                    <label>Imagem</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden" name="image" id="image">

                        @php
                            $class_background = $our_release->image != '' ? 'w-background' : '';
                            $style_background = $our_release->image != '' ? "style='background-image: url(" . url("/img/uploads/our-releases/{$our_release->image}") . ")'" : '';
                        @endphp

                        <div class="preview-img {{ $class_background }}" {!! $style_background !!}>
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Arraste o marcador no mapa para selecionar o local desta propriedade</label>
                    <input type="hidden" class="form-control" id="latitude" name="latitude"
                        value="{{ $our_release->latitude }}" />
                    <input type="hidden" class="form-control" id="longitude" name="longitude"
                        value="{{ $our_release->longitude }}" />
                    <div id="crud-map" style="height: 400px;"></div>
                </div>

                <div class="differentials default-space-between">

                    @foreach ($differentials as $diff)
                        <div class="default-input-group">
                            <label>Diferenciais</label>

                            <input class="geral-input" placeholder="Diferenciais" type="text" name="differentials[]"
                                maxlength="150" value="{{ $diff->text }}">
                        </div>
                    @endforeach


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

        <div class="actions d-flex">
            <button type="button" class="btn-geral btn-green mr-2" onclick="window.history.go(-1)">Voltar</button>
            <input type="submit" class="btn-geral ms-2" value="Enviar">
        </div>

    </form>

    <script>
        var url = "{{ route('our_release.update') }}";
        var url_to_redirect = "{{ route('our_releases.list') }}";
    </script>
@endsection
