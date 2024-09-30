<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\LoginAdmin;
use App\Http\Controllers\Admin\CityController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\GalleryController;

use App\Http\Controllers\Site\SiteHomeController;
use App\Http\Controllers\Site\SiteAboutController;
use App\Http\Controllers\Site\SiteContactController;
use App\Http\Controllers\Site\SiteCookiesController;
use App\Http\Controllers\Site\SitePropertyController;
use App\Http\Controllers\Site\SiteConstructionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Insira todas as rotas do site 
|
*/

Route::namespace("Site")->group(
    function () {

        Route::any('/', [SiteHomeController::class, 'index'])->name("site.home");
        Route::any('/sobre-nos', [SiteAboutController::class, 'index'])->name("site.about");
        Route::any('/obras', [SiteConstructionController::class, 'index'])->name("site.constructions");
        Route::any('/imoveis/{type?}/{filter?}', [SitePropertyController::class, 'index'])->name("site.properties");
        Route::any('/imovel/{property_url}', [SitePropertyController::class, 'details'])->name("site.property_details");
        Route::any('/lancamento/{property_url}', [SitePropertyController::class, 'detailsRelease'])->name("site.release_details");
        Route::any('/contato', [SiteContactController::class, 'index'])->name("site.contact");
        Route::any('/politica-de-cookies', [SiteCookiesController::class, 'index'])->name("site.cookies_policy");

        Route::any('/sendContact', [SiteHomeController::class, 'sendContact'])->name("contact.send");
        Route::any('/getBanner', [SiteHomeController::class, 'getBanner'])->name("site.getBanner");

        Route::any('/locationsFilter', [SitePropertyController::class, 'locationsFilter'])->name("locations.filter");
        Route::any('/releasesFilter', [SitePropertyController::class, 'releasesFilter'])->name("releases.filter");
    }

);


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Insira todas as rotas do gestor
|
*/

use App\Http\Controllers\Admin\PageHomeController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\Admin\PageAboutController;
use App\Http\Controllers\Admin\OurReleaseController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\PageContactController;
use App\Http\Controllers\Admin\ConstructionController;
use App\Http\Controllers\Admin\CookiePolicyController;
use App\Http\Controllers\Admin\NeighborhoodController;
use App\Http\Controllers\Admin\PropertyTypeController;
use App\Http\Controllers\Admin\ReleaseUnityController;
use App\Http\Controllers\Admin\PagePropertiesController;
use App\Http\Controllers\Admin\PageConstructionController;


Route::namespace("Admin")->group(
    function () {

        Route::prefix('content-adm')->group(
            function () {
                Route::any('/', [LoginAdmin::class, 'index'])->name('login.page');
            }

        );
        Route::any('/loginAdmin', [LoginAdmin::class, 'login'])->name("admin.login");
        Route::any('/logoutAdmin', [LoginAdmin::class, 'logout'])->name("admin.logout");

        Route::middleware('auth.user')->group(
            function () {

                Route::prefix('content-adm')->group(
                    function () {
                        Route::any('/dashboard', [Dashboard::class, 'index'])->name("dashboard");

                        // Gestores
                        Route::any('/lista-gestores', [AdminController::class, 'index'])->name("admin.list");
                        Route::any('/adicionar-gestor', [AdminController::class, 'create'])->name("admin.add");
                        Route::any('/editar-gestor/{id}', [AdminController::class, 'edit'])->name("admin.edit");

                        // Banner
                        Route::any('/lista-banners', [BannerController::class, 'index'])->name("banner.list");
                        Route::any('/adicionar-banner', [BannerController::class, 'create'])->name("banner.add");
                        Route::any('/editar-banner/{id}', [BannerController::class, 'edit'])->name("banner.edit");

                        // Construcoes
                        Route::any('/lista-construcoes', [ConstructionController::class, 'index'])->name("constructions.list");
                        Route::any('/adicionar-construcao', [ConstructionController::class, 'create'])->name("construction.add");
                        Route::any('/editar-construcao/{id}', [ConstructionController::class, 'edit'])->name("construction.edit");

                        // Cidades
                        Route::any('/lista-cidades', [CityController::class, 'index'])->name("cities.list");
                        Route::any('/adicionar-cidade', [CityController::class, 'create'])->name("city.add");
                        Route::any('/editar-cidade/{id}', [CityController::class, 'edit'])->name("city.edit");

                        // Bairros
                        Route::any('/lista-bairros', [Neighborhoodcontroller::class, 'index'])->name("neighborhood.list");
                        Route::any('/adicionar-bairros', [Neighborhoodcontroller::class, 'create'])->name("neighborhood.add");
                        Route::any('/editar-bairros/{id}', [Neighborhoodcontroller::class, 'edit'])->name("neighborhood.edit");

                        // Propriedades
                        Route::any('/lista-propriedades', [Propertycontroller::class, 'index'])->name("property.list");
                        Route::any('/adicionar-propriedades', [Propertycontroller::class, 'create'])->name("property.add");
                        Route::any('/editar-propriedades/{id}', [Propertycontroller::class, 'edit'])->name("property.edit");

                        // PropertyTypecontroller
                        Route::any('/lista-tipos-imovel', [PropertyTypecontroller::class, 'index'])->name("property_type.list");
                        Route::any('/adicionar-tipo-imovel', [PropertyTypecontroller::class, 'create'])->name("property_type.add");
                        Route::any('/editar-tipo-imovel/{id}', [PropertyTypecontroller::class, 'edit'])->name("property_type.edit");

                        // Lançamentos
                        Route::any('/lista-lancamentos', [OurReleasecontroller::class, 'index'])->name("our_releases.list");
                        Route::any('/adicionar-lancamento', [OurReleasecontroller::class, 'create'])->name("our_release.add");
                        Route::any('/editar-lancamento/{id}', [OurReleasecontroller::class, 'edit'])->name("our_release.edit");

                        // Unidades
                        Route::any('/lista-unidades/{release_id}', [ReleaseUnityController::class, 'index'])->name("unity.list");
                        Route::any('/adicionar-unidade/{release_id}', [ReleaseUnityController::class, 'create'])->name("unity.add");
                        Route::any('/editar-unidade/{id}', [ReleaseUnityController::class, 'edit'])->name("unity.edit");

                        // Galerias
                        Route::any('/editar-galeria/{type}/{item_id}', [GalleryController::class, 'edit'])->name("gallery.edit");

                        // Paginas
                        // About
                        Route::any('/editar-pagina-sobre', [PageAboutController::class, 'edit'])->name("page_about.edit");
                        // Constructions
                        Route::any('/editar-pagina-construcoes', [PageConstructionController::class, 'edit'])->name("page_construction.edit");
                        // Properties
                        Route::any('/editar-pagina-propriedades', [PagePropertiesController::class, 'edit'])->name("page_property.edit");
                        // Contato
                        Route::any('/editar-pagina-contato', [PageContactController::class, 'edit'])->name("page_contact.edit");
                        // Home
                        Route::any('/editar-home', [PageHomeController::class, 'edit'])->name("page_home.edit");

                        // Informacoes de contato
                        Route::any('/editar-informacoes-contato', [ContactInfoController::class, 'edit'])->name("contact_info.edit");

                        // Política de Cookies
                        Route::any('/editar-politica-cookies', [CookiePolicyController::class, 'edit'])->name("cookie_policy.edit");
                    }

                );

                // Gestores
                Route::any('/addAdmin', [AdminController::class, 'store'])->name("admin.store");
                Route::any('/changeAdmin', [AdminController::class, 'update'])->name("admin.update");
                Route::any('/deleteAdmin', [AdminController::class, 'updateStatus'])->name("admin.delete");
                Route::any('/deleteMultipleAdmin', [AdminController::class, 'updateMultipleStatus'])->name("admin.delete_multiple");
                Route::any('/copyAdmin', [AdminController::class, 'copy'])->name("admin.copy");

                // Banner
                Route::any('/addBanner', [BannerController::class, 'store'])->name("banner.store");
                Route::any('/changeBanner', [BannerController::class, 'update'])->name("banner.update");
                Route::any('/deleteBanner', [BannerController::class, 'updateStatus'])->name("banner.delete");
                Route::any('/deleteMultipleBanner', [BannerController::class, 'updateMultipleStatus'])->name("banner.delete_multiple");
                Route::any('/organizeBanner', [BannerController::class, 'organizeBanner'])->name("banner.organize");
                Route::any('/copyBanner', [BannerController::class, 'copy'])->name("banner.copy");

                // Galeria
                Route::any('/addGallery', [GalleryController::class, 'createMultipleImages'])->name("gallery.update");
                Route::any('/updateGallery', [GalleryController::class, 'updateGalleryImageAlt'])->name("gallery.updateAlt");
                Route::any('/deleteGallery', [GalleryController::class, 'updateStatus'])->name("gallery.delete");
                Route::any('/organizeGallery', [GalleryController::class, 'organizeGallery'])->name("gallery.organize");

                // Construcoes
                Route::any('/addConstruction', [ConstructionController::class, 'store'])->name("construction.store");
                Route::any('/changeConstruction', [ConstructionController::class, 'update'])->name("construction.update");
                Route::any('/deleteConstruction', [ConstructionController::class, 'updateStatus'])->name("construction.delete");
                Route::any('/deleteMultipleConstruction', [ConstructionController::class, 'updateMultipleStatus'])->name("construction.delete_multiple");
                Route::any('/organizeConstruction', [ConstructionController::class, 'organizeConstruction'])->name("construction.organize");
                Route::any('/copyConstruction', [ConstructionController::class, 'copy'])->name("construction.copy");

                // Propriedades
                Route::any('/addProperty', [PropertyController::class, 'store'])->name("property.store");
                Route::any('/changeProperty', [PropertyController::class, 'update'])->name("property.update");
                Route::any('/deleteProperty', [PropertyController::class, 'updateStatus'])->name("property.delete");
                Route::any('/deleteMultipleProperty', [PropertyController::class, 'updateMultipleStatus'])->name("property.delete_multiple");
                Route::any('/organizeProperty', [PropertyController::class, 'organizeProperty'])->name("property.organize");
                Route::any('/copyProperty', [PropertyController::class, 'copy'])->name("property.copy");

                // PropertyTypeController
                Route::any('/addPropertyType', [PropertyTypeController::class, 'store'])->name("property_type.store");
                Route::any('/changePropertyType', [PropertyTypeController::class, 'update'])->name("property_type.update");
                Route::any('/deletePropertyType', [PropertyTypeController::class, 'updateStatus'])->name("property_type.delete");
                Route::any('/deleteMultiplePropertyType', [PropertyTypeController::class, 'updateMultipleStatus'])->name("property_type.delete_multiple");
                Route::any('/organizePropertyType', [PropertyTypeController::class, 'organizePropertyType'])->name("property_type.organize");
                Route::any('/copyPropertyType', [PropertyTypeController::class, 'copy'])->name("property_type.copy");

                // Lancamentos
                Route::any('/addOurRelease', [OurReleaseController::class, 'store'])->name("our_release.store");
                Route::any('/changeOurRelease', [OurReleaseController::class, 'update'])->name("our_release.update");
                Route::any('/deleteOurRelease', [OurReleaseController::class, 'updateStatus'])->name("our_release.delete");
                Route::any('/deleteMultipleOurRelease', [OurReleaseController::class, 'updateMultipleStatus'])->name("our_release.delete_multiple");
                Route::any('/organizeOurRelease', [OurReleaseController::class, 'organizeOurRelease'])->name("our_release.organize");
                Route::any('/copyOurRelease', [OurReleaseController::class, 'copy'])->name("our_release.copy");

                // Unidades
                Route::any('/addUnity', [ReleaseUnityController::class, 'store'])->name("unity.store");
                Route::any('/changeUnity', [ReleaseUnityController::class, 'update'])->name("unity.update");
                Route::any('/deleteUnity', [ReleaseUnityController::class, 'updateStatus'])->name("unity.delete");
                Route::any('/deleteMultipleUnities', [ReleaseUnityController::class, 'updateMultipleStatus'])->name("unity.delete_multiple");
                Route::any('/organizeUnity', [ReleaseUnityController::class, 'organizeUnity'])->name("unity.organize");

                // Cidades
                Route::any('/addCity', [CityController::class, 'store'])->name("city.store");
                Route::any('/changeCity', [CityController::class, 'update'])->name("city.update");
                Route::any('/deleteCity', [CityController::class, 'updateStatus'])->name("city.delete");
                Route::any('/deleteMultipleCity', [CityController::class, 'updateMultipleStatus'])->name("city.delete_multiple");
                Route::any('/organizeCity', [CityController::class, 'organizeCity'])->name("city.organize");
                Route::any('/copyCity', [CityController::class, 'copy'])->name("city.copy");

                // Bairros
                Route::any('/addNeighborhood', [NeighborhoodController::class, 'store'])->name("neighborhood.store");
                Route::any('/changeNeighborhood', [NeighborhoodController::class, 'update'])->name("neighborhood.update");
                Route::any('/deleteNeighborhood', [NeighborhoodController::class, 'updateStatus'])->name("neighborhood.delete");
                Route::any('/deleteMultipleNeighborhood', [NeighborhoodController::class, 'updateMultipleStatus'])->name("neighborhood.delete_multiple");
                Route::any('/organizeNeighborhood', [NeighborhoodController::class, 'organizeNeighborhood'])->name("neighborhood.organize");
                Route::any('/copyNeighborhood', [NeighborhoodController::class, 'copy'])->name("neighborhood.copy");

                // Paginas
                // About
                Route::any('/changePageAbout', [PageAboutController::class, 'update'])->name("page_about.update");
                // Construction
                Route::any('/changePageConstruction', [PageConstructionController::class, 'update'])->name("page_construction.update");
                // Propriedades
                Route::any('/changePageProperties', [PagePropertiesController::class, 'update'])->name("page_property.update");
                // Contato
                Route::any('/changePageContact', [PageContactController::class, 'update'])->name("page_contact.update");
                // Home
                Route::any('/changePageHome', [PageHomeController::class, 'update'])->name("page_home.update");

                // Informacoes de contato
                Route::any('/changeContactInfo', [ContactInfoController::class, 'update'])->name("contact_info.update");

                // Informacoes de contato
                Route::any('/changeCookiePolicy', [CookiePolicyController::class, 'update'])->name("cookie_policy.update");
            }

        );
    }

);
