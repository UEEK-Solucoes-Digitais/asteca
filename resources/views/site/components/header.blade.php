<header>
    <div class="container-fluid">

        <div class="container">
            <nav class="nav-default">
                <div class="background"></div>
                <div class="nav-menu">

                    <a class="logo" href="{{ route('site.home') }}" title="{{ config('app.name') }}"
                        aria-label="{{ config('app.name') }} ">
                        <img src="{{ url('/img/site/brand/logo.svg') }}" alt="Logo Asteca" class="logo-white">
                        <img src="{{ url('/img/site/brand/logo-red.svg') }}" alt="Logo Asteca" class="logo-red">
                    </a>
                    <div class="nav-mobile-links">

                        <a class="logo-mobile" href="{{ route('site.home') }}" title="{{ config('app.name') }}"
                            aria-label="{{ config('app.name') }} ">
                            <img src="{{ url('/img/site/brand/logo.svg') }}" alt="Logo Asteca" class="logo-white">
                        </a>

                        <ul class="nav-links">
                            <li>
                                <a class="header-link {{ request()->routeIs('site.home') ? 'active' : '' }}"
                                    href="{{ route('site.home') }}" title="Home">Home</a>
                            </li>
                            <li>
                                <a class="header-link {{ request()->routeIs('site.about') ? 'active' : '' }}"
                                    href="{{ route('site.about') }}" title="Sobre nós">Sobre nós</a>
                            </li>
                            <li>
                                <a class="header-link {{ request()->routeIs('site.constructions') ? 'active' : '' }}"
                                    href="{{ route('site.constructions') }}" title="Obras">Obras</a>
                            </li>
                            <li>
                                <a class="header-link {{ request()->routeIs('site.properties') || request()->routeIs('site.property_details') || request()->routeIs('site.release_details') ? 'active' : '' }}"
                                    href="{{ route('site.properties') }}" title="Imóveis">Imóveis</a>
                            </li>
                            <li>
                                <a class="header-link {{ request()->routeIs('site.contact') ? 'active' : '' }}"
                                    href="{{ route('site.contact') }}" title="Contato">Contato</a>
                            </li>

                            <li class="social">
                                <a class="header-link social-link" href="{{ $contact_info->facebook }}"
                                    title="Nosso Facebook">
                                    <iconify-icon icon="eva:facebook-outline"></iconify-icon>
                                </a>

                                <a class="header-link social-link" href="{{ $contact_info->instagram }}"
                                    title="Nosso Instagram">
                                    <iconify-icon icon="akar-icons:instagram-fill"></iconify-icon>
                                </a>
                            </li>

                            <li class="cookie">
                                <a class="header-link " href="{{ route('site.cookies_policy') }}"
                                    title="Política de cookies">
                                    Política de cookies
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="nav-toggle">
                    <button class="button button-action button-primary nav-button">
                        <span class="span-menu"></span>
                        <span class="span-menu"></span>
                        <span class="span-menu"></span>
                    </button>
                </div>
            </nav>
        </div>
    </div>

</header>
