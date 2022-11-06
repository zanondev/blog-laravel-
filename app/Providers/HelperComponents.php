<?php

namespace App\Providers;

use App\Models\PostCategory;
use Illuminate\Support\ServiceProvider;

class HelperComponents extends ServiceProvider
{
    public function register()
    {
        foreach (glob(app_path('Helpers') . '/Backend/*.php') as $file) {
            require_once $file;
        }
    }

    public function boot()
    {
        view()->composer('*', function ($view) {
            if (!$view->offsetExists('list_variables')) {
                $trash_iconify = '<span class="iconify" data-icon="ci:trash-empty"></span>';
                $pen_iconify = '<span class="iconify" data-icon="akar-icons:edit"></span>';
                $eye_iconify = '<span class="iconify" data-icon="akar-icons:eye-open"></span>';
                $eye_slash_iconify = '<span class="iconify" data-icon="heroicons-outline:eye-off"></span>';
                $images_iconify = '<span class="iconify" data-icon="bi:images"></span>';

                $post_categories = PostCategory::where('status', 1)->get();
                $view->with('post_categories', $post_categories);
                
                $view->with('pen_iconify', $pen_iconify);
                $view->with('trash_iconify', $trash_iconify);
                $view->with('eye_iconify', $eye_iconify);
                $view->with('eye_slash_iconify', $eye_slash_iconify);
                $view->with('images_iconify', $images_iconify);
                $view->with('pen_iconify', $pen_iconify);
            }
        });
    }
}
