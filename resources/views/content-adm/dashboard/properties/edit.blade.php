@extends('content-adm.dashboard.shared.layout')
@section('content')
    <div class="loading-form"></div>

    <h1>Editar Propriedade - {{ $property->title }}</h1>

    <form class="default-form geral-form">
        @csrf
        <input type="hidden" name="id" value={{ $property->id }} />
        <div class="fields default-space-between form-space">

            <div class="blue-background default-space-between">

                <div class="default-input-group">
                    <label>Imagem</label>
                    <div class="image-preview">
                        <input type="file" class="input-image-hidden " name="image" id="image">

                        @php
                            $class_background = $property->image != '' ? 'w-background' : '';
                            $style_background = $property->image != '' ? "style='background-image: url(" . url("/img/uploads/properties/{$property->image}") . ")'" : '';
                        @endphp

                        <div class="preview-img {{ $class_background }}" {!! $style_background !!}>
                            <iconify-icon icon="akar-icons:plus"></iconify-icon>
                        </div>

                    </div>
                </div>

                <div class="default-input-group">
                    <label>Descrição</label>
                    <textarea class="geral-input required ckeditor-text" type="text" placeholder="Digite aqui" id="description"
                        name="description">{{ $property->description }}</textarea>
                </div>

                <div class="geral-grid-div column-2">

                    <div class="default-input-group">
                        <label>Título</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="title"
                            value="{{ $property->title }}">
                    </div>

                    <div class="default-input-group">
                        <label>Endereço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="address"
                            value="{{ $property->address }}">
                    </div>

                </div>

                <div class="geral-grid-div column-4">

                    {{-- <div class="default-input-group">
                        <label>Cidade</label>
                        <select class="geral-input" name="city_id">
                            @foreach ($cities as $city)
                                <option {{ $property->city_id == $city->id ? 'selected' : '' }}
                                    value="{{ $city->id }}">
                                    {{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="default-input-group">
                        <label>Bairro</label>
                        <select class="geral-input" name="neighborhood_id">
                            @foreach ($neighborhoods as $neighborhood)
                                <option {{ $property->neighborhood_id == $neighborhood->id ? 'selected' : '' }}
                                    value="{{ $neighborhood->id }}">{{ $neighborhood->name }}</option>
                            @endforeach
                        </select>
                    </div> --}}

                    <div class="default-input-group">
                        <label>WhatsApp</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="whatsapp"
                            onkeydown="Mascara(this, Telefone)" maxlength="15" value="{{ $property->whatsapp }}">
                    </div>

                    <div class="default-input-group">
                        <label>Área (em m²)</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="area"
                            value="{{ $property->area }}">
                    </div>

                    <div class="default-input-group">
                        <label>Tipo do imóvel</label>
                        <select class="geral-input required" name="property_type_id">
                            @foreach ($property_types as $property_type)
                                <option value="{{ $property_type->id }}"
                                    {{ $property_type->id == $property->property_type_id ? ' selected' : '' }}>
                                    {{ $property_type->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="default-input-group">
                        <label>Preço</label>
                        <input class="geral-input required" type="text" placeholder="Digite aqui" name="price"
                            onkeydown="Mascara(this, Valor)"
                            value="{{ number_format((float) $property->price, 2, ',', '.') }}">
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
    
                        @foreach ($infos as $info)
                            <div class="default-input-group">
                                <label>Informações adicionais</label>
    
                                <input class="geral-input" placeholder="Título" type="text" name="infos_title[]"
                                    maxlength="150" value="{{ $info->info_title }}">
                                <input class="geral-input" placeholder="Valor" type="text" name="infos_value[]"
                                    onkeydown="Mascara(this, Valor)"
                                    value="{{ number_format((float) $info->info_value, 2, ',', '.') }}">
                            </div>
                        @endforeach

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
        var url = "{{ route('property.update') }}";
        var url_to_redirect = "{{ route('property.list') }}";
    </script>
@endsection
