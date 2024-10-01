@php
    $GLOBALS['location'] = $_SERVER['REQUEST_URI'];
    
    $location = $GLOBALS['location'];
    
    $current_page = explode('/', $_SERVER['REQUEST_URI']);
    $current_page = $current_page[1];
    
@endphp

<!DOCTYPE html>
<html lang="pt-br" class="no-js">

<head>

    <meta charset="UTF-8">
    <meta name="robots" content="noindex,nofollow">
    <meta name="author" content="UEEK Soluções Digitais">
    <meta name="viewport"
        content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=0">
    <link rel="shortcut icon" href="{{ url('/img/site/brand/favicon.svg') }}">

    <title>@yield('page_title', config('app.name'))</title>
    <meta name='description' content='@yield('page_description')'>
    <meta property='og:title' content='@yield('page_title', config('app.name'))'>
    <meta property='og:type' content='website'>
    <meta property='og:image' content='{{ url('/img/site/brand/big-logo.jpg') }}'>
    <meta property='og:site_name' content='@yield('page_title', config('app.name'))'>
    <meta property='og:description' content='@yield('page_description')'>
    <link rel='canonical' href='https://{{ $_SERVER['HTTP_HOST'] }}/{{ $current_page }}'>

    <link rel="preload" as="style" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </noscript>

    <link rel="preload" as="style"
        href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css">
    </noscript>

    <link rel="preload" as="style" href="{{ url('lib/selectFx/cs-select.css') }}"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ url('lib/selectFx/cs-select.css') }}">
    </noscript>

    <link rel="preload" as="style" href="{{ url('lib/selectFx/cs-skin-border.css') }}"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="{{ url('lib/selectFx/cs-skin-border.css') }}">
    </noscript>

    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    </noscript>

    <!-- CSS DO PROJETO -->

    <link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.css">
    </noscript>

    <link href="https://cdn.jsdelivr.net/npm/shareon@2/dist/shareon.min.css" rel="stylesheet" />

    @vite(['resources/assets/less/site/style.less'])

    <script src="https://code.iconify.design/iconify-icon/1.0.1/iconify-icon.min.js"></script>

    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script defer src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

    <script defer src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

    <script defer src="{{ url('lib/selectFx/selectFx.js') }}"></script>
    <script defer src="{{ url('lib/selectFx/classie.js') }}"></script>
    <script defer src="{{ url('lib/selectFx/config-select.js') }}"></script>

    <script defer src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/shareon@2/dist/shareon.iife.js" init></script>

    @vite(['resources/assets/js/site/main.js'])
</head>

<body>

    @include('site.components.header')

    <main>
        @yield('content')

        <div class="custom-modal" id="result-modal">
            <div class="background"></div>
            <div class="content default-space-between">
                <button class="close-modal"><span class="iconify" data-icon="clarity:times-line"></span></button>
                <div class="custom-modal-body">
                    <h2 class="geral-title"></h2>
                    <p class="geral-text"></p>
                </div>
            </div>
        </div>
    </main>

    @include('site.components.footer')

</body>

</html>
