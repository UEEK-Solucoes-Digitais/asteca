<picture>
    <source type="image/webp" srcset="{{ url("{$webp}") }}">
    <source type="image/png" srcset="{{ url("{$image}") }}">
    <img data-src="{{ url("{$image}") }}" alt="{{ $alt }}"
        class="{{ stripos($customClass, 'swiper-lazy') !== false ? "{$customClass}" : "lazy {$customClass}" }}"
        width="{{ $customWidth }}" height="{{ $customHeight }}">
</picture>
@if (stripos($customClass, 'swiper-lazy') !== false)
    <div class="swiper-lazy-preloader"></div>
@endif
