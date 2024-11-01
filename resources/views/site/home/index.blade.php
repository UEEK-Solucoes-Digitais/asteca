@section('page_title')
    {{ $page_home->seo_title }}
@endsection
@section('page_description')
    {!! $page_home->seo_text !!}
@endsection

@extends('site.shared.layout')
@section('content')
    <section class="container-fluid fadeIn" id="banner">
        <article class="container">
            <div class="content">
                <h1>{{ $banners[0]->title }}</h1>
                <div class="text">{!! $banners[0]->text !!}</div>
                <a href="{{ $banners[0]->link }}" class="btn-geral">{{ $banners[0]->btn_text }}</a>
            </div>
        </article>
        <div class="background-area">
            <x-ImageComponent webp="/img/uploads/banners/{{ $banners[0]->image_webp }}"
                image="/img/uploads/banners/{{ $banners[0]->image }}" alt="" customClass="background-image"
                customWidth="1920" customHeight="900" />
            <div class="background-linear"></div>
        </div>

        <div class="banner-swiper swiper-container">
            <div class="swiper-wrapper">
                @foreach ($banners as $key => $banner)
                    <div class="swiper-slide">
                        <button class="banner-item change-banner-image-js {{ $key == 0 ? 'active' : '' }}"
                            title="{{ $banner->title }}" aria-label="Exibir banner {{ $banner->titple }}"
                            data-value="{{ $banner->id }}">
                            <img class="banner-icon" src="{{ url("/img/uploads/banners/{$banner->logo}") }}">
                            {{ $banner->title }}
                        </button>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="container-fluid geral-section" id="home-about">
        <article class="container fadeIn">
            <div class="content">
                <h2 title="{{ $page_about->title }}">{{ $page_about->title }}</h2>
                <div class="ckeditor-text">
                    {!! $page_about->text !!}
                </div>
                <a href="{{ route('site.about') }}" class="btn-geral" title="Saiba mais">Saiba mais</a>
            </div>
        </article>

        <div class="about-swiper swiper-container sequenced-bottom ">
            <div class="swiper-wrapper">
                @foreach ($images as $image)
                    <div class="swiper-slide">
                        <a class="image-item" href="{{ $image->alt_text ? $image->alt_text : url("/img/uploads/gallery/{$image->image}") }}"
                            data-fancybox="Galeria Sobre nós" title="{{ $image->alt_text }}"
                            data-caption="{{ $image->alt_text }}" aria-label="{{ $image->alt_text }}">
                            <x-ImageComponent webp="/img/uploads/gallery/{{ $image->image_webp }}"
                                image="/img/uploads/gallery/{{ $image->image }}" alt="{{ $image->alt_text }}"
                                customClass="swiper-lazy" customWidth="680" customHeight="430" />

                                @if($image->alt_text)
                                    <button type="button" class="play-button">
                                        <iconify-icon icon="weui:play-filled"></iconify-icon>
                                    </button>
                                @endif
                            <div class="background"></div>
                        </a>
                    </div>
                @endforeach

            </div>
            <div class="swiper-pagination"></div>

        </div>
    </section>

    <section class="container-fluid constructions-section home-construction geral-section">
        {{-- <div class="background-grey"></div> --}}
        <div class="container">
            <div class="section-header">
                <h2 class="sequenced-bottom">{{ $page_home->constructions_title }}</h2>
                <div class="sequenced-bottom">{!! $page_home->constructions_text !!}</div>
            </div>

            <div class="constructions list-to-paginate">
                @foreach ($constructions as $key => $construction)
                    <a class="construction pagination-item sequenced-bottom" data-bs-toggle="modal"
                        data-bs-target="#modal-construction-{{ $key }}">
                        <div class="image">
                            {{-- <img class="image-construction"
                                src="{{ url('/img/site/images/about-image.png') }}"> --}}
                            <x-ImageComponent image="/img/uploads/constructions/{{ $construction->image }}"
                                webp="img/uploads/constructions/{{ $construction->image_webp }}"
                                alt="Imagem de frente do banner" customClass="background-person" customWidth="500"
                                customHeight="950" />
                            <div class="background-linear"></div>
                        </div>
                        <div class="text">
                            <h5>{{ $construction['title'] }}</h5>
                            <div class="description">{!! $construction['text'] !!}</div>
                        </div>
                    </a>
                @endforeach

            </div>

            <a href="{{ route('site.constructions') }}" class="btn-geral" title="Ver todos">Ver todos</a>

        </div>
    </section>

    <section class="geral-section container-fluid" id="properties-for-location">
        <div class="background"></div>
        <article class="container sequenced-bottom">
            <div class="section-header">
                <h2 class="sequenced-bottom">{{ $page_home->properties_title }}</h2>
                <div class="sequenced-bottom">{!! $page_home->properties_text !!}</div>
            </div>

            <div class="properties-grid">
                @foreach ($properties as $property)
                    <x-PropertyComponent title="{{ $property->title }}" address="{{ $property->address }}"
                        area="{{ $property->area }}m²" price="{{ $property->price }}" url="{{ $property->url }}"
                        type="1" 
                        image="{{ $property->is_from_api === 1 ? $property->image : '/img/uploads/properties/' . $property->image }}"
                        imageWebp="{{ $property->is_from_api === 1 ? $property->image_webp : '/img/uploads/properties/' . $property->image_webp }}"/>
                @endforeach
            </div>

            <a href="{{ route('site.properties') }}" class="btn-geral" title="Ver todos">Ver todos</a>

        </article>
    </section>

    <section class="container-fluid" id="contact">
        <article class="container sequenced-bottom">
            <h2>Fale conosco</h2>
            <p>Lorem ipsum dolor sit amet consectetur adiscipling.</p>

            <div class="contact-flex sequenced-bottom">
                <div class="map leftShow">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d14116.5641229785!2d-50.285396!3d-27.8054295!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x544cf6614249d9fd!2sAsteca%20Constru%C3%A7%C3%A3o%20Civil%20Ltda.!5e0!3m2!1spt-BR!2sbr!4v1665767562914!5m2!1spt-BR!2sbr"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="contact-links rightShow">
                    <a href="https://wa.me/+55{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->whatsapp) }}"
                        class="contact-item" title="Enviar mensagem pelo WhatsApp">
                        <div class="icon">
                            <iconify-icon icon="akar-icons:whatsapp-fill"></iconify-icon>
                            Whatsapp
                        </div>
                        {{ $contact_info->whatsapp }}
                    </a>
                    <a href="tel:{{ preg_replace('/[\(|\)\-_\s+]/', '', $contact_info->phone) }}" class="contact-item"
                        title="Ligar para {{ $contact_info->phone }}">
                        <div class="icon">
                            <iconify-icon icon="carbon:phone"></iconify-icon>
                            Telefone
                        </div>
                        {{ $contact_info->phone }}
                    </a>
                    <a href="mailto: {{ $contact_info->email }}" class="contact-item"
                        title="Enviar email para {{ $contact_info->email }}">
                        <div class="icon">
                            <iconify-icon icon="ci:mail"></iconify-icon>
                            E-mail
                        </div>
                        {{ $contact_info->email }}
                    </a>
                </div>
            </div>
        </article>
    </section>

    <script>
        const url_site = "{{ route('site.home') }}"
        const getBannerRoute = "{{ route('site.getBanner') }}"
        const token_value = "{{ csrf_token() }}"
    </script>
@endsection
