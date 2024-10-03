@section('page_title')
    {{ $property->title }}
@endsection
@section('page_description')
    {!! $property->description !!}
@endsection


@extends('site.shared.layout')

@section('content')
    <section class="container-fluid taped-section" id="rental">
        <article class="container">
            <div class="breadcrumb-property fadeIn">
                <a href="{{ route('site.properties') }}" title="Imóveis" class="item">Imóveis</a>
                <p title="{{ $property->title }}" class="item current">{{ $property->title }}</p>
            </div>

            <div class="property-details-body">
                @if (count($images) > 0)
                    <div class="property-gallery-area fadeIn">
                        <div class="image">
                            @php
                                $firstImage = $images[0];
                                $imageUrl = $firstImage->is_from_api == 1 ? $firstImage->image : url('/img/uploads/gallery/' . $firstImage->image);
                            @endphp
                            <a href="{{ $imageUrl }}" data-fancybox="Galeria da propriedade">
                                <img src="{{ $imageUrl }}" alt="imagem do prédio">
                            </a>
                        </div>

                        <div class="property-gallery swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($images as $image)
                                    @php
                                        $imageUrl = $image->is_from_api == 1 ? $image->image : '/img/uploads/gallery/' . $image->image;
                                        $imageWebpUrl = $image->is_from_api == 1 ? $image->image_webp : '/img/uploads/gallery/' . $image->image_webp;
                                    @endphp
                                    <div class="swiper-slide">
                                        <button class="change-gallery-image">
                                            <x-ImageComponent
                                                webp="{{ $imageWebpUrl }}"
                                                image="{{ $imageUrl }}"
                                                alt="{{ $image->alt_text }}"
                                                customClass="swiper-lazy"
                                                customWidth="680"
                                                customHeight="430"
                                            />
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                <div class="content fadeIn">
                    <h1>{{ $property->title }}</h1>
                    <p class="address">
                        <iconify-icon icon="akar-icons:location"></iconify-icon>
                        {{ $property->address }}
                    </p>

                    <div class="property-details">
                        <p class="details-title">Detalhes do imóvel</p>
                        <div class="simditor-text">
                            {!! $property->description !!}
                        </div>
                    </div>

                    <p class="area">
                        <img src="{{ url('/img/site/images/area-red.svg') }}" alt="Ícone de m²">
                        {{ $property->area }}m²
                    </p>

                    <p class="price">
                        R${{ number_format($property->price, 2, ',', '.') }}
                    </p>

                    <button class="condominium-value">
                        Condomínio R${{ number_format($property_infos_sum, 2, ',', '.') }}
                        <iconify-icon icon="akar-icons:chevron-down"></iconify-icon>

                        <div class="value-details">
                            @foreach ($property_infos as $property_info)
                                <p><b>{{ $property_info->info_title }}</b>
                                    R${{ number_format($property_info->info_value, 2, ',', '.') }}<br></p>
                            @endforeach
                        </div>
                    </button>

                    <a href="https://wa.me/+55{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->whatsapp) }}"
                        class="btn-whatsapp" title="Está interessado? Fale conosco!">
                        <iconify-icon icon="akar-icons:whatsapp-fill"></iconify-icon>
                        Está interessado? Fale conosco!
                    </a>
                    <div class="share-area">
                        <p>Compartilhar:</p>

                        <div class="shareon">
                            <a class="facebook"></a>
                            <button class="whatsapp"></button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    @if (count($related_properties) > 0)
        <section class="container-fluid geral-section" id="related-properties">
            <article class="container">
                <h2>Você também pode gostar</h2>

                <div class="properties-grid">
                    @foreach ($related_properties as $property)
                        <x-PropertyComponent title="{{ $property->title }}" address="{{ $property->address }}"
                            area="{{ $property->area }}m²" price="{{ $property->price }}" url="{{ $property->url }}"
                            type="1" image="{{ $property->is_from_api === 1 ? $property->image : '/img/uploads/properties/' . $property->image }}"
                            imageWebp="{{ $property->is_from_api === 1 ? $property->image_webp : '/img/uploads/properties/' . $property->image_webp }}" />
                    @endforeach

                </div>

                <a href="{{ route('site.properties') }}" class="btn-geral" title="Ver todos">Ver todos</a>
            </article>
        </section>
    @endif
@endsection
