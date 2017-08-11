<?php 

namespace JD\PageBanners;

use Backend;
use System\Classes\PluginBase;
use Cms\Classes\Page as PageModel;
use JD\PageBanners\Models\Banner as BannerModel;

/**
 * PageBanners Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'PageBanners',
            'description' => 'No description provided yet...',
            'author'      => 'JD',
            'icon'        => 'icon-leaf'
        ];
    }

    /**
     * Register method, called when the plugin is first registered.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        PageModel::extend(function ($model) {
            $model->addDynamicMethod('banners', function() use ($model) {
                return BannerModel::where('page_id', $model->id);
            });
        });
    }

    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'banner_images' => function($page) {
                    $pageBanner = $page->banners()->first();
                    
                    return $pageBanner ? $pageBanner->images : null;
                }
            ],
        ];
    }

    /**
     * Registers any front-end components implemented in this plugin.
     *
     * @return array
     */
    public function registerComponents()
    {
        return []; // Remove this line to activate

        return [
            'JD\PageBanners\Components\MyComponent' => 'myComponent',
        ];
    }

    /**
     * Registers any back-end permissions used by this plugin.
     *
     * @return array
     */
    public function registerPermissions()
    {
        return []; // Remove this line to activate

        return [
            'jd.pagebanners.some_permission' => [
                'tab' => 'PageBanners',
                'label' => 'Some permission'
            ],
        ];
    }

    /**
     * Registers back-end navigation items for this plugin.
     *
     * @return array
     */
    public function registerNavigation()
    {
        return [
            'pagebanners' => [
                'label'       => 'Page Banners',
                'url'         => Backend::url('jd/pagebanners/banners'),
                'icon'        => 'icon-picture-o',
                'permissions' => ['jd.pagebanners.*'],
                'order'       => 500,
            ],
        ];
    }
}
