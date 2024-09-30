@php
    
    $location = $GLOBALS['location'];
    
    $link_dashboard = '';
    $link_admin = '';
    $link_banners = '';
    $link_page_about = '';
    $link_page_construction = '';
    $link_page_properties = '';
    $link_page_contact = '';
    $link_contact_info = '';
    $link_cookie_policy = '';
    $link_constructions = '';
    $link_cities = '';
    $link_neighborhoods = '';
    $link_properties = '';
    $link_releases = '';
    $link_home_gallery = '';
    $link_property_type = '';
    $link_page_home = '';
    
    switch (true) {
        case stripos($location, 'dashboard') !== false:
            $link_dashboard = 'active';
            break;
    
        case stripos($location, 'gestor') !== false:
            $link_admin = 'active';
            break;
    
        case stripos($location, 'tipo-imovel') !== false || stripos($location, 'tipos-imovel') !== false:
            $link_property_type = 'active';
            break;
    
        case stripos($location, 'banner') !== false:
            $link_banners = 'active';
            break;
    
        case stripos($location, 'pagina-sobre') !== false:
            $link_page_about = 'active';
            break;
    
        case stripos($location, 'pagina-construcoes') !== false:
            $link_page_construction = 'active';
            break;
    
        case stripos($location, 'pagina-propriedades') !== false:
            $link_page_properties = 'active';
            break;
    
        case stripos($location, 'informacoes-contato') !== false:
            $link_page_contact = 'active';
            break;
    
        case stripos($location, 'informacoes-contato') !== false:
            $link_contact_info = 'active';
            break;
    
        case stripos($location, 'politica-cookies') !== false:
            $link_cookie_policy = 'active';
            break;
    
        case stripos($location, 'construcoes') !== false:
            $link_constructions = 'active';
            break;
    
        case stripos($location, 'cidade') !== false:
            $link_cities = 'active';
            break;
    
        case stripos($location, 'bairro') !== false:
            $link_neighborhoods = 'active';
            break;
    
        case stripos($location, 'propriedade') !== false:
            $link_properties = 'active';
            break;
    
        case stripos($location, 'lancamento') !== false:
            $link_releases = 'active';
            break;
    
        case stripos($location, 'galeria-home') !== false:
            $link_home_gallery = 'active';
            break;
    
        case stripos($location, 'editar-home') !== false:
            $link_page_home = 'active';
            break;
    }
    
@endphp

<aside class='general-dashboard-aside'>
    <div class="background"></div>
    <nav class='first-top-padding'>

        <div class="sidebar-head-items">
            <div class="sidebar-head-collapsed">
                <iconify-icon icon="akar-icons:arrow-right"></iconify-icon>
            </div>
            <div class="sidebar-head">
                <a class='sidebar-link sidebar-logo' href="{{ route('dashboard') }}"
                    title="{{ config('app.name') }} | Admin">
                    <img src="{{ url('/img/site/brand/logo.svg') }}" alt="{{ config('app.name') }} | Admin">
                </a>

                <span class="version-ueek">
                    <b>adm</b> vs 3.0
                </span>
            </div>

            <div class="nav-toggle">
                <button class="nav-button" aria-label="Fechar menu mobile">
                    <span class="span-menu"></span>
                    <span class="span-menu"></span>
                    <span class="span-menu"></span>
                </button>
            </div>
        </div>

        <div class="sidebar-divider"></div>

        <div class="sidebar-links">

            <div class="group-links">

                <p class="label-links-collapsed">●●</p>
                <p class="label-links">Gestão de conteúdo</p>

                <a class="sidebar-link {{ $link_dashboard }}" href="{{ route('dashboard') }}">
                    <iconify-icon icon="ic:round-dashboard"></iconify-icon>
                    <span>Dashboard</span>
                </a>

                <a class="sidebar-link {{ $link_banners }}" href="{{ route('banner.list') }}">
                    <iconify-icon icon="fa6-regular:images"></iconify-icon>
                    <span>Banners</span>
                </a>

                <a class="sidebar-link {{ request()->routeIs('contact_info.edit') ? 'active' : '' }}"
                    href="{{ route('contact_info.edit') }}">
                    <iconify-icon icon="akar-icons:phone"></iconify-icon>
                    <span>Informações de contato</span>
                </a>

                <a class="sidebar-link {{ $link_cookie_policy }}" href="{{ route('cookie_policy.edit') }}">
                    <iconify-icon icon="bx:cookie"></iconify-icon>
                    <span>Política de Cookies</span>
                </a>




            </div>

            <div class="group-links">

                <p class="label-links-collapsed">●●</p>
                <p class="label-links">Comercial</p>

                <a class="sidebar-link {{ $link_constructions }} {{ request()->routeIs('construction.edit') || request()->routeIs('construction.add') ? 'active' : '' }}"
                    href="{{ route('constructions.list') }}">
                    <iconify-icon icon="emojione-monotone:building-construction"></iconify-icon>
                    <span>Obras</span>
                </a>
                <a class="sidebar-link {{ $link_property_type }}" href="{{ route('property_type.list') }}">
                    <iconify-icon icon="bi:tag"></iconify-icon>
                    <span>Tipos de imóvel</span>
                </a>
                <a class="sidebar-link {{ $link_properties }}" href="{{ route('property.list') }}">
                    <iconify-icon icon="fa:building-o"></iconify-icon>
                    <span>Propriedades</span>
                </a>
                <a class="sidebar-link {{ $link_releases }} {{ request()->routeIs('unity.list') || request()->routeIs('unity.add') || request()->routeIs('unity.edit') ? 'active' : '' }}"
                    href="{{ route('our_releases.list') }}">
                    <iconify-icon icon="akar-icons:calendar"></iconify-icon>
                    <span>Lançamentos</span>
                </a>

                {{-- <a class="sidebar-link {{ $link_cities }}" href="{{ route('cities.list') }}">
                    <iconify-icon icon="mdi:city-variant-outline"></iconify-icon>
                    <span>Cidades</span>
                </a>
                <a class="sidebar-link {{ $link_neighborhoods }}" href="{{ route('neighborhood.list') }}">
                    <iconify-icon icon="healthicons:village-outline"></iconify-icon>
                    <span>Bairros</span>
                </a> --}}

            </div>

            <div class="group-links">

                <p class="label-links-collapsed">●●</p>
                <p class="label-links">Páginas</p>

                {{-- <a class="sidebar-link {{ $link_page_construction }}"
                    href="{{ route('gallery.edit', ['type' => 5, 'item_id' => 10001]) }}">
                    <iconify-icon icon="ooui:image-gallery"></iconify-icon>
                    <span>Página Home - Galeria</span>
                </a> --}}

                <div class="collapse-group">
                    <a class="sidebar-link {{ $link_page_home }}" data-bs-toggle="collapse" href="#collapseHome"
                        role="button" aria-expanded="false" aria-controls="collapseHome">
                        <iconify-icon icon="fluent:document-one-page-24-filled"></iconify-icon>

                        <span>Página - Home</span>
                        <iconify-icon icon="akar-icons:chevron-down"></iconify-icon>
                    </a>
                    <div class="collapse multi-collapse" id="collapseHome">
                        <a class="sidebar-link {{ request()->routeIs('page_home.edit') ? 'active' : '' }}"
                            href="{{ route('page_home.edit') }}">
                            <iconify-icon icon="bx:layer"></iconify-icon>
                            <span>Conteúdo</span>
                        </a>

                        <a class="sidebar-link" href="{{ route('gallery.edit', ['type' => 5, 'item_id' => 10001]) }}">
                            <iconify-icon icon="ooui:image-gallery"></iconify-icon>
                            <span>Galeria</span>
                        </a>

                    </div>
                </div>

                <div class="collapse-group">
                    <a class="sidebar-link {{ $link_page_about }}" data-bs-toggle="collapse" href="#collapseproduct"
                        role="button" aria-expanded="false" aria-controls="collapseproduct">
                        <iconify-icon icon="fluent:document-one-page-24-filled"></iconify-icon>

                        <span>Página - Sobre</span>
                        <iconify-icon icon="akar-icons:chevron-down"></iconify-icon>
                    </a>
                    <div class="collapse multi-collapse" id="collapseproduct">
                        <a class="sidebar-link" href="{{ route('page_about.edit') }}">
                            <iconify-icon icon="bx:layer"></iconify-icon>
                            <span>Conteúdo</span>
                        </a>
                        <a class="sidebar-link " href="{{ route('gallery.edit', ['type' => 6, 'item_id' => 10000]) }}">
                            <iconify-icon icon="ooui:image-gallery"></iconify-icon>
                            <span>Galeria</span>
                        </a>

                    </div>
                </div>

                <a class="sidebar-link {{ $link_page_construction }}" href="{{ route('page_construction.edit') }}">
                    <iconify-icon icon="fluent:document-one-page-24-filled"></iconify-icon>
                    <span>Página - Obras</span>
                </a>
                <a class="sidebar-link {{ $link_page_properties }}" href="{{ route('page_property.edit') }}">
                    <iconify-icon icon="fluent:document-one-page-24-filled"></iconify-icon>
                    <span>Página - Propriedades</span>
                </a>
                <a class="sidebar-link {{ request()->routeIs('page_contact.edit') ? 'active' : '' }}"
                    href="{{ route('page_contact.edit') }}">
                    <iconify-icon icon="fluent:document-one-page-24-filled"></iconify-icon>
                    <span>Página - Contato</span>
                </a>
            </div>



            <div class="group-links">

                <p class="label-links-collapsed">●●</p>
                <p class="label-links">Configurações</p>

                <a class="sidebar-link {{ $link_admin }}" href="{{ route('admin.list') }}">
                    <iconify-icon icon="majesticons:users-line"></iconify-icon>
                    <span>Usuários gestores</span>
                </a>

            </div>

        </div>

    </nav>
</aside>
