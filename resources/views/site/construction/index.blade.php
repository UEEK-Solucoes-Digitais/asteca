@section('page_title')
    {{ $page_construction->seo_title }}
@endsection
@section('page_description')
    {!! $page_construction->seo_text !!}
@endsection

@extends('site.shared.layout') @section('content')
    <section class="container-fluid first-section construction-first">
        <div class="container">
            <div class="initial-content fadeIn">
                <h1>{{ $page_construction['title'] }}</h1>
                <p>{!! $page_construction['text'] !!}</p>
            </div>
        </div>
    </section>
    <section class="container-fluid constructions-section geral-section">
        <div class="background-grey"></div>
        <div class="container">
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
            <div class="geral-pagination" id="pagination-construction"></div>
        </div>
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

    @foreach ($constructions as $key => $construction)
        @php
            $images = \App\Models\Gallery::where('status', 1)
                ->where('type', 3)
                ->where('item_id', $construction->id)
                ->orderBy('position', 'asc')
                ->get();
        @endphp
        <div class="modal modal-with-swiper fade" id="modal-construction-{{ $key }}" tabindex="-1"
            aria-labelledby="modal-construction-{{ $key }}-label" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                    <div class="modal-swiper swiper-container" id="swiper-{{ $key }}">
                        <div class="swiper-wrapper">
                            @foreach ($images as $image)
                                <div class="swiper-slide">
                                    <a class="gallery-item" href="{{ url("/img/uploads/gallery/{$image->image}") }}"
                                        data-fancybox="construction-gallery-{{ $key }}">
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
                                        webp="img/uploads/gallery/{{ $image->image_webp }}" alt="{{ $image->alt_text }}"
                                        customClass="swiper-lazy gallery-item" customWidth="500" customHeight="950" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
