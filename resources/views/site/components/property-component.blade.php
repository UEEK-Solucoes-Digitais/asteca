@if ($type == 3)
    <a class="property-item sequenced-bottom" data-bs-toggle="modal" data-bs-target="#modal-unity-{{ $url }}">
        <div class="image">
            <x-ImageComponent webp="{{ $imageWebp }}" image="{{ $image }}" alt="Imóvel - {{ $title }}"
                customClass="property-image" customWidth="360" customHeight="470" />
            <div class="background-linear"></div>
        </div>
        <div class="content">
            <h3 class="title">{{ $title }}</h3>
        </div>
    </a>
@else
    <a class="property-item {{ $type != 2 && $type != 1 ? 'sequenced-bottom' : '' }} pagination-item"
        href="{{ $type == 1 ? route('site.property_details', ['property_url' => $url]) : route('site.release_details', ['property_url' => $url]) }}"
        title="Imóvel - {{ $title }}" aria-label="Imóvel - {{ $title }}">
        <div class="image">
            <x-ImageComponent webp="{{ $imageWebp }}" image="{{ $image }}"
                alt="Imóvel - {{ $title }}" customClass="property-image" customWidth="360" customHeight="470" />
            <div class="background-linear"></div>
        </div>
        <div class="content">
            <h3 class="title">{{ $title }}</h3>
            <p class="address">{{ $address }}</p>
            <div class="property-details">
                <div class="area">
                    <img src="{{ url('/img/site/images/area.svg') }}" alt="Ícone de metro quadrado">
                    <span>{{ $area }}</span>
                </div>
                @if ($type == 1)
                    <p class="price">R${{ number_format($price, 2, ',', '.') }}</p>
                @endif
            </div>
        </div>
    </a>
@endif
