@section('page_title')
    {{ $release->title }}
@endsection
@section('page_description')
    {!! $release->description !!}
@endsection

@extends('site.shared.layout')

@section('content')
    <section class="container-fluid fadeIn" id="release-banner">
        <div class="image-background">
            <x-ImageComponent webp="/img/uploads/our-releases/{{ $release->image_webp }}"
                image="/img/uploads/our-releases/{{ $release->image }}" alt="{{ $release->title }}"
                customClass="release-image" customWidth="1920" customHeight="900" />
            <div class="background-linear"></div>
        </div>
        <article class="container">
            <div class="breadcrumb-property release-breadcrumb">
                <a href="{{ route('site.properties') }}" title="Imóveis" class="item">Imóveis</a>
                <p title="{{ $release->title }}" class="item current">{{ $release->title }}</p>
            </div>

            <div class="banner-content">
                <h1>{{ $release->title }}</h1>
                <p>{{ $release->subtitle }}</p>
            </div>
        </article>

        <div class="release-swiper swiper-container">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <a class="image-item" href="{{ url("/img/uploads/gallery/{$image->image}") }}"
                            data-fancybox="Galeria Lançamento" title="{{ $image->alt_text }}"
                            data-caption="{{ $image->alt_text }}" aria-label="{{ $image->alt_text }}">
                            <x-ImageComponent webp="/img/uploads/gallery/{{ $image->image_webp }}"
                                image="/img/uploads/gallery/{{ $image->image }}" alt="{{ $image->alt_text }}"
                                customClass="swiper-lazy" customWidth="680" customHeight="430" />
                            <div class="background"></div>
                        </a>
                    </div>
                @endforeach
            </div>
    </section>

    <section class="container-fluid" id="release-details">
        <article class="container">
            <h2 class="detail-title sequenced-bottom">Detalhes do imóvel</h2>
            <div class="ckeditor-text sequenced-bottom">
                {!! $release->description !!}
            </div>

            <div class="release-differentials sequenced-bottom">
                <h2 class="detail-title">Diferenciais</h2>
                <div class="list">
                    <ul>
                        @foreach ($release_differentials as $release_differential)
                            <li>{{ $release_differential->text }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </article>
    </section>

    <section class="container-fluid geral-section" id="release-progress">
        <article class="container fadeIn">
            <div class="progress-flex">
                <h2>Acompanhe a evolução da obra</h2>

                <div class="progress-infos">
                    <div class="info-text">
                        <p>
                            <b>Data de início</b><br>
                            {{ date('d/m/Y', strtotime($release->initial_date)) }}
                        </p>

                        <p>
                            <b>Previsão de conclusão</b><br>
                            {{ date('d/m/Y', strtotime($release->final_date)) }}
                        </p>
                    </div>

                    <div class="info-graph">
                        <div class='circle'>

                            <input type='hidden' name='progress-value' value='{{ $release->percentage_done }}'>

                            <div class='circle-infos'>

                                <svg class='progress-ring' width='160' height='160'>
                                    <circle id='circle' class='progress-ring-circle' stroke='currentcolor'
                                        fill='transparent' r='60' cx='80' cy='80' />
                                </svg>

                            </div>

                            <div class='percentage-area'>
                                <h3>{{ $release->percentage_done }}%</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </section>

    <section class="container-fluid" id="release-units">
        <article class="container">
            <h2>Unidades disponíveis</h2>

            <div class="properties-grid list-to-paginate">
                @foreach ($release_units as $release_unit)
                    <x-PropertyComponent title="{{ $release_unit->title }}" address="" area="" price=""
                        url="{{ $release_unit->id }}" type="3" image="/img/uploads/unities/{{ $release_unit->image }}"
                        imageWebp="/img/uploads/unities/{{ $release_unit->image_webp }}" />
                @endforeach
            </div>
        </article>
    </section>

    <section class="container-fluid" id="release-location">
        <article class="container">
            <h2 class="sequenced-bottom">Localização</h2>

            <div id="map" class="sequenced-bottom"></div>

            <script>
                function initMap() {
                    const myLatLng = {
                        lat: parseFloat("{{ $release->latitude }}"),
                        lng: parseFloat("{{ $release->longitude }}")
                    };
                    const map = new google.maps.Map(document.getElementById("map"), {
                        zoom: 12,
                        center: myLatLng,
                    });

                    new google.maps.Marker({
                        position: myLatLng,
                        map,
                    });
                }
            </script>
            <script
                        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBMwZxse9_m2kI3nK1oNwXetISURkd-yzs&callback=initMap&v=weekly&channel=2">
            </script>

        </article>
    </section>

    @foreach ($release_units as $key => $unity)
        @php
            $images = \App\Models\Gallery::where('status', 1)
                ->where('type', 4)
                ->where('item_id', $unity->id)
                ->orderBy('position', 'asc')
                ->get();
        @endphp
        <div class="modal modal-with-swiper fade" id="modal-unity-{{ $unity->id }}" tabindex="-1"
            aria-labelledby="modal-unity-{{ $unity->id }}-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="modal-swiper swiper-container" id="swiper-{{ $unity->id }}">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <a class="gallery-item" href="{{ url("/img/uploads/gallery/{$image->image}") }}"
                                        data-fancybox="unity-gallery-{{ $unity->id }}">
                                        <x-ImageComponent image="/img/uploads/gallery/{{ $image->image }}"
                                            webp="img/uploads/gallery/{{ $image->image_webp }}"
                                            alt="{{ $image->alt_text }}" customClass="swiper-lazy" customWidth="500"
                                            customHeight="950" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <div class="swiper-button-next">
                            <iconify-icon icon="akar-icons:chevron-right"></iconify-icon>
                        </div>
                        <div class="swiper-button-prev">
                            <iconify-icon icon="akar-icons:chevron-left"></iconify-icon>
                        </div>
                    </div>

                    <div class="modal-thumb-swiper swiper-container" id="swiper-thumb-{{ $key }}">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <x-ImageComponent image="/img/uploads/gallery/{{ $image->image }}"
                                        webp="img/uploads/gallery/{{ $image->image_webp }}"
                                        alt="{{ $image->alt_text }}" customClass="swiper-lazy gallery-item"
                                        customWidth="500" customHeight="950" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
