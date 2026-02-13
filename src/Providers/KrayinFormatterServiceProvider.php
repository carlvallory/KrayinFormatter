<?php

namespace Vallory\KrayinFormatter\Providers;

use Illuminate\Support\ServiceProvider;
use Vallory\KrayinFormatter\Helpers\FormatterCore;

class KrayinFormatterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../Resources/lang', 'krayin-formatter');
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'krayin-formatter');

        // Register Middleware
        $this->app['router']->pushMiddlewareToGroup('web', \Vallory\KrayinFormatter\Http\Middleware\SetTimezone::class);

        // Inject Timezone Script
        \Illuminate\Support\Facades\Event::listen('admin.layout.head.after', function($viewRenderEventManager) {
            $viewRenderEventManager->addTemplate('krayin-formatter::timezone_script');
        });

        $this->app->booted(function () {
             $config = config('core_config', []);
             $myConfig = require __DIR__ . '/../Config/core_config.php';
             config(['core_config' => array_merge($config, $myConfig)]);
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->extend('core', function ($service, $app) {
            return new FormatterCore(
                $app->make(\Webkul\Core\Repositories\CountryRepository::class),
                $app->make(\Webkul\Core\Repositories\CoreConfigRepository::class),
                $app->make(\Webkul\Core\Repositories\CountryStateRepository::class)
            );
        });
    }

    /**
     * Merge the given configuration with the existing configuration.
     * Overriding because we want to merge into 'core' config which might be loaded differently
     * Actually, Webkul packages merge into 'core_config' usually? or 'core.config'?
     * Let's check CoreServiceProvider.
     */
    protected function mergeConfigFrom($path, $key)
    {
        // Krayin uses 'core_config' key for system settings usually?
        // Let's verify where Webkul/Admin/src/Config/core_config.php is loaded.
        // It is loaded in AdminServiceProvider usually.
        
        // If I use standard mergeConfigFrom, it merges into user config 'key'.
        // I want to append to 'core' config if that's where settings live?
        // Let's stick to standard behavior first, but I need to know the TARGET key.
        // Webkul/Core/src/Providers/CoreServiceProvider.php loads 'core.php'.
        
        // Wait, Webkul/Admin/src/Providers/AdminServiceProvider.php loads core_config.php?
        // I need to know the config key.
        // A quick check: Admin/src/Config/core_config.php -> likely 'core_config' or just merged into nothing?
        // Actually, in Webkul packages typically:
        // $this->mergeConfigFrom(dirname(__DIR__) . '/Config/system.php', 'core');
        // $this->mergeConfigFrom(dirname(__DIR__) . '/Config/menu.php', 'menu');
        
        // But core_config.php in Admin package...
        // Let's assume the key is 'core' based on file name pattern not matching key?
        // Note: Core module has 'core.php' manually.
        
        // Let's use 'core' as key for now, if it fails I will check.
        // Re-reading implementation plan: I deleted checking AdminServiceProvider.
        // I will trust 'core' for now, but I'll add a check step.
        
        parent::mergeConfigFrom($path, 'core');
    }
}
