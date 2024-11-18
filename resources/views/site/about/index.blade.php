@section('page_title')
    {{ $page_about->seo_title }}
@endsection
@section('page_description')
    {!! $page_about->seo_text !!}
@endsection

@extends('site.shared.layout')
@section('content')
    <section class="container-fluid first-section about-first">
        <div class="container fadeIn">
            <div class="initial-content">
                <h1>{{ $page_about['title'] }}</h1>
                <div>{!! $page_about['text'] !!}</div>
            </div>
        </div>
        <div class="about-image">

            <img class="lazy about-image-1 background-person"
                data-src="{{ url("/img/uploads/page_about/{$page_about->image}") }}" alt="">
        </div>
    </section>
    <section class="container-fluid about-second">
        <div class="container">
            <h3 class="fadeIn">{{ $page_about['msv_title'] }}</h3>

            <div class="items">
                <div class="item sequenced-bottom">
                    <iconify-icon icon="codicon:target"></iconify-icon>
                    <h5>Missão</h5>
                    <div>{!! $page_about['mission_text'] !!}</div>
                </div>

                <div class="item sequenced-bottom">
                    <iconify-icon icon="bi:eye"></iconify-icon>
                    <h5>Visão</h5>
                    <div>{!! $page_about['vision_text'] !!}</div>

                </div>

                <div class="item sequenced-bottom">
                    <iconify-icon icon="bi:star"></iconify-icon>
                    <h5>Valores</h5>
                    <div>{!! $page_about['values_text'] !!}</div>

                </div>
            </div>
        </div>
    </section>

    <section class="history-section fadeIn">

        <div class="about-swiper swiper-container ">
            <div class="swiper-wrapper">
                @foreach ($gallery as $gallery)
                    <div class="swiper-slide">
                        <a class="image-item" href="/img/uploads/gallery/{{ $gallery->image }}"
                            data-fancybox="Galeria Sobre nós" title="Lorem ipsum" data-caption="Lorem ipsum"
                            aria-label="Lorem ipsum">
                            <x-ImageComponent image="/img/uploads/gallery/{{ $gallery->image }}"
                                webp="img/uploads/gallery/{{ $gallery->image_webp }}" alt="Imagem de frente do banner"
                                customClass="about-image-2 background-person swiper-lazy" customWidth="500"
                                customHeight="950" />
                            <div class="background-linear-gradient-left"></div>
                            <div class="background-linear-gradient-right"></div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination"></div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <h3 class="fadeIn">{{ $page_about->history_title }}</h3>

                <div class="history-flex  ckeditor-text fadeIn">
                    {!! $page_about->history_text !!}
                </div>
            </div>
        </div>
    </section>
@endsection
