<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\ContactInfo;

class HelperComponents extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path('Helpers') . '/Site/*.php') as $file) {
            require_once $file;
        }

        foreach (glob(app_path('Helpers') . '/Backend/*.php') as $file) {
            require_once $file;
        }
    }

    public function boot()
    {
        view()->composer('*', function ($view) {
            if (!$view->offsetExists('list_variables')) {
                $trash_iconify = '<iconify-icon icon="ci:trash-empty"></iconify-icon>';
                $pen_iconify = '<iconify-icon icon="akar-icons:edit"></iconify-icon>';
                $eye_iconify = '<iconify-icon icon="akar-icons:eye-open"></iconify-icon>';
                $eye_slash_iconify = '<iconify-icon icon="heroicons-outline:eye-off"></iconify-icon>';
                $images_iconify = '<iconify-icon icon="bi:images"></iconify-icon>';
                $contact_info = ContactInfo::find($id = 1);

                $view->with('pen_iconify', $pen_iconify);
                $view->with('trash_iconify', $trash_iconify);
                $view->with('eye_iconify', $eye_iconify);
                $view->with('eye_slash_iconify', $eye_slash_iconify);
                $view->with('images_iconify', $images_iconify);
                $view->with('contact_info', $contact_info);
            }
        });
    }
}
