<?php

namespace Adminetic\Announcement\Provider;

use Adminetic\Announcement\Contracts\AnnouncementRepositoryInterface;
use Adminetic\Announcement\Models\Admin\Announcement;
use Adminetic\Announcement\Policies\AnnouncementPolicy;
use Adminetic\Announcement\Repositories\AnnouncementRepository;
use Adminetic\Announcement\View\Components\AnnouncementNotificationBell;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class AnnouncementServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Announcement::class => AnnouncementPolicy::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Ressource
        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }
        // Register Resources
        $this->registerResource();
        // Register Policies
        $this->registerPolicies();
        // Register View Components
        $this->registerComponents();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /* Repository Interface Binding */
        $this->repos();
        /* Register AnnouncementEventServiceProvider */
        $this->app->register(AnnouncementEventServiceProvider::class);
    }

    /**
     * Publish Package Resource.
     *
     *@return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__.'/../../config/announcement.php' => config_path('announcement.php'),
        ], 'announcement-config');
        // Publish View Files
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/adminetic/plugin/announcement'),
        ], 'announcement-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'announcement-migrations');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'announcement'); // Loading Views Files
        $this->registerRoutes();
    }

    /**
     * Register Routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        });
    }

    /**
     * Register Route Configuration.
     *
     * @return void
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => config('announcement.prefix', 'admin'),
            'middleware' => config('announcement.middleware', ['web', 'auth']),
        ];
    }

    /**
     * Register Components.
     *
     *@return void
     */
    protected function registerComponents()
    {
        $this->loadViewComponentsAs('announcement', [
            AnnouncementNotificationBell::class,
        ]);
    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(AnnouncementRepositoryInterface::class, AnnouncementRepository::class);
    }

    /**
     * Register Policies.
     *
     *@return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
