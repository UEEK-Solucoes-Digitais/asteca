<footer class="{{ request()->routeIs('site.constructions') || request()->routeIs('site.home') ? 'with-form' : '' }}">
    <div class="container-fluid">
        <div class="container">

            <div class="footer-nav">
                <ul class="nav-links">
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.home') ? 'active' : '' }}"
                            href="{{ route('site.home') }}" title="Home">Home</a>
                    </li>
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.about') ? 'active' : '' }}"
                            href="{{ route('site.about') }}" title="Sobre nós">Sobre nós</a>
                    </li>
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.constructions') ? 'active' : '' }}"
                            href="{{ route('site.constructions') }}" title="Obras">Obras</a>
                    </li>
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.properties') || request()->routeIs('site.property_details') || request()->routeIs('site.release_details') ? 'active' : '' }}"
                            href="{{ route('site.properties') }}" title="Imóveis">Imóveis</a>
                    </li>
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.contact') ? 'active' : '' }}"
                            href="{{ route('site.contact') }}" title="Contato">Contato</a>
                    </li>
                </ul>
                <ul class="nav-links social-links">
                    <li>
                        <a class="footer-link social-link" href="{{ $contact_info->facebook }}" title="Nosso Facebook">
                            <iconify-icon icon="eva:facebook-outline"></iconify-icon>
                        </a>
                    </li>
                    <li>
                        <a class="footer-link social-link" href="{{ $contact_info->instagram }}"
                            title="Nosso Instagram">
                            <iconify-icon icon="akar-icons:instagram-fill"></iconify-icon>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="footer-nav">
                <a href="{{ route('site.home') }}" class="logo" title="{{ config('app.name') }}">
                    <img src="{{ url('/img/site/brand/logo-red.svg') }}" alt="Logo {{ config('app.name') }}">
                </a>

                <ul class="nav-links mobile-links">
                    <li>
                        <a class="footer-link social-link" href="{{ $contact_info->facebook }}" title="Nosso Facebook">
                            <iconify-icon icon="eva:facebook-outline"></iconify-icon>
                        </a>
                    </li>
                    <li>
                        <a class="footer-link social-link" href="{{ $contact_info->instagram }}"
                            title="Nosso Instagram">
                            <iconify-icon icon="akar-icons:instagram-fill"></iconify-icon>
                        </a>
                    </li>
                </ul>

                <ul class="nav-links">
                    <li>
                        <a class="footer-link {{ request()->routeIs('site.cookies_policy') ? 'active' : '' }}"
                            href="{{ route('site.cookies_policy') }}" title="Política de Cookies">Política de
                            Cookies</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
