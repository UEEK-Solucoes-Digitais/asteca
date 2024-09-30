@extends('content-adm.dashboard.shared.layout')

@section('content')
    <div class="default-space-between">

        <!-- Page Heading -->
        <h1 class="geral-title">Dashboard</h1>

        <p class="geral-text">Bem vindo(a) ao seu painel administrativo.</p>

        <div class="image-tips blue-background">

            <div class="icon">
                <iconify-icon icon="carbon:idea"></iconify-icon>
            </div>

            <div class="text default-space-between">
                <h2 class="geral-subtitle">Fique de olho no tamanho das imagens do seu site</h2>

                <p class="geral-text">
                    <b>[Dica de otimização e melhoria de carregamento]</b>
                    Imagens otimizadas (que permitem o carregamento rápido das páginas) são muito importantes para o
                    desempenho do seu site. Então, antes de carregá-las no sistema gestor, recomendamos que você comprima e
                    redimensione as imagens caso estejam muito grandes.
                    Imagens com mais de 1MB são consideradas pesadas, e isso pode fazer com que seu site demore a carregar,
                    nesse caso, comprima-as.
                </p>

                <p class="geral-text">
                    As proporções ideais para fotos usadas em banners são de 1920x1080.
                    Para fotos que serão exibidas em galerias no site (como detalhes de produtos ou fotos institucionais),
                    as dimensões ideais são de 1280x720.
                </p>

                <p class="geral-text">
                    Você consegue comprimir ou redimensionar imagens por conta própria utilizando ferramentas online
                    gratuitas. Para compressão ou redimensionamento, você pode usar o site <a
                        href="https://www.iloveimg.com/pt/" target="_blank">iLoveIMG</a> ou, somente para comprimir, você
                    pode usar o <a href="https://tinypng.com/" target="_blank">TinyPNG</a>.
                </p>

                </p>
            </div>

        </div>
    </div>
@endsection
