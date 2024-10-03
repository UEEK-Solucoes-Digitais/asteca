@section('page_title')
    {{ $page_properties->seo_title }}
@endsection
@section('page_description')
    {{ $page_properties->seo_text }}
@endsection

@extends('site.shared.layout')

@section('content')

    @php
        $param_url = explode('/', $_SERVER['REQUEST_URI']);
        $filter = false;
        $type = false;
        if(isset($param_url[2])){
            $type = $param_url[2];
            $filter = $param_url[3];
        }
    @endphp

    <section class="container-fluid first-section properties-first">
        <div class="container">
            <div class="initial-content">
                <h1 class="fadeIn">{{ $page_properties->title }}</h1>
                <div class="ckeditor-text fadeIn mb-4">
                    {!! $page_properties->text !!}
                </div>

                <div class="d-flex fadeIn">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="btn-geral-secondary {{ !$type ? 'active' : '' }} {{ $type && $type == 'locacao' ? 'active' : ''}}" id="rental-tab" data-bs-toggle="tab"
                                data-bs-target="#rental-tab-pane" type="button" role="tab"
                                aria-controls="rental-tab-pane" aria-selected="true">Locação</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="btn-geral-secondary ms-2 {{ $type && $type == 'lancamentos' ? 'active' : ''}}" id="releases-tab" data-bs-toggle="tab"
                                data-bs-target="#releases-tab-pane" type="button" role="tab"
                                aria-controls="releases-tab-pane" aria-selected="true">Lançamentos</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid geral-section" id="properties">
        <article class="container">
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade {{ !$type ? 'show active' : '' }} {{ $type && $type == 'locacao' ? 'show active' : ''}}" id="rental-tab-pane" role="tabpanel" aria-labelledby="rental-tab"
                    tabindex="0">
                    <div class="property-filter">
                        @php
                            $total = count($properties);
                        @endphp
                        <h2>
                            @if($total > 0)
                                {{ $total }} imóve{{ $total > 1 ? 'is' : 'l' }} encontrado{{ $total > 1 ? 's' : '' }}.
                            @endif
                            @if($total == 0)
                                Nenhum imóvel encontrado.
                            @endif
                        </h2>

                        <form class="filters filter-properties">
                            <input type="hidden" name="type" value="1">
                            <div class="default-input-group">
                                <label>Tipo do imóvel</label>
                                <select name="property_type" class="property-type-select cs-select cs-skin-border">
                                    <option value="0">Todos</option>
                                    @foreach ($property_types as $property_type)
                                        <option {{$filter && $type == 'locacao' && $filter == $property_type->id ? 'selected' : ''}} value="location-{{ $property_type->id }}">
                                            {{ $property_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="default-input-group">
                                <label>Filtrar por</label>
                                <select name="property_type" class="cs-select cs-skin-border">
                                    <option value="price asc">Menor preço</option>
                                    <option value="price desc">Maior preço</option>
                                    <option value="date desc">Mais antigos</option>
                                    <option value="date asc">Mais recentes</option>
                                    <option value="title asc">A - Z</option>
                                    <option value="title desc">Z - A</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="properties-grid list-to-paginate">
                        @foreach ($properties as $property)
                            <x-PropertyComponent title="{{ $property->title }}" address="{{ $property->address }}"
                                area="{{ $property->area }}m²" price="{{ $property->price }}" url="{{ $property->url }}"
                                type="1" image="{{ $property->is_from_api === 1 ? $property->image : '/img/uploads/properties/' . $property->image }}"
                                imageWebp="{{ $property->is_from_api === 1 ? $property->image_webp : '/img/uploads/properties/' . $property->image_webp }}" />
                        @endforeach

                    </div>

                    <div class="geral-pagination" id="pagination-rental"></div>

                </div>
                <div class="tab-pane fade {{ $type && $type == 'lancamentos' ? 'show active' : ''}}" id="releases-tab-pane" role="tabpanel" aria-labelledby="releases-tab"
                    tabindex="0">
                    <div class="property-filter">
                        @php
                            $total = count($releases);
                        @endphp
                        <h2>
                            @if($total > 0)
                                {{ $total }} imóve{{ $total > 1 ? 'is' : 'l' }} encontrado{{ $total > 1 ? 's' : '' }}.
                            @endif
                            @if($total == 0)
                                Nenhum imóvel encontrado.
                            @endif
                        </h2>

                        <form class="filters filter-properties">
                            <input type="hidden" name="type" value="1">
                            <div class="default-input-group">
                                <label>Tipo do imóvel</label>
                                <select name="property_type" class="property-type-select cs-select cs-skin-border">
                                    <option value="0">Todos</option>
                                    @foreach ($property_types as $property_type)
                                        <option {{$filter && $type == 'lancamentos' && $filter == $property_type->id ? 'selected' : ''}} value="release-{{ $property_type->id }}">
                                            {{ $property_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="default-input-group">
                                <label>Filtrar por</label>
                                <select name="property_type" class="cs-select cs-skin-border">
                                    <option value="price asc">Menor preço</option>
                                    <option value="price desc">Maior preço</option>
                                    <option value="date desc">Mais antigos</option>
                                    <option value="date asc">Mais recentes</option>
                                    <option value="title asc">A - Z</option>
                                    <option value="title desc">Z - A</option>
                                </select>
                            </div>
                        </form>
                    </div>

                    <div class="properties-grid list-to-paginate">
                        @foreach ($releases as $release)
                            <x-PropertyComponent title="{{ $release->title }}" address="{{ $release->address }}"
                                area="{{ $release->area }}" price="" url="{{ $release->url }}" type="2"
                                image="/img/uploads/our-releases/{{ $release->image }}"
                                imageWebp="/img/uploads/our-releases/{{ $release->image_webp }}" />
                        @endforeach
                    </div>

                    <div class="geral-pagination" id="pagination-releases"></div>
                </div>
            </div>
        </article>
    </section>
    <section class="container-fluid geral-section" id="contact-whatsapp">
        <article class="container">
            <div class="contact-flex">
                <h2>Fale conosco pelo WhatsApp</h2>
                <a href="https://wa.me/+55{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->whatsapp) }}"
                    target="_blank" class="btn-whatsapp" title="Enviar mensagem pelo WhatsApp">
                    <iconify-icon icon="akar-icons:whatsapp-fill"></iconify-icon>
                    Enviar mensagem pelo WhatsApp
                </a>
            </div>
        </article>
    </section>
@endsection

<script>
    var location_filter_url = "{{ route('locations.filter') }}"
    var release_filter_url = "{{ route('releases.filter') }}"
</script>