<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    protected $namespace_user = 'App\Http\Controllers\User';
    protected $namespace_auth = 'App\Http\Controllers\Auth';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();
        $this->mapWebRoutes();

        $this->mapSettingsRoutes();
        $this->mapAdminRoutes();
        $this->mapAppointmentsRoutes();
        $this->mapAccountsRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    /**
     * Define the "settings" routes for the application.
     *
     * @return void
     */
    protected function mapSettingsRoutes()
    {
        Route::prefix('settings')
             ->middleware('web')
             ->namespace($this->namespace_user)
             ->group(base_path('routes/custom/settings.php'));
    }

    /**
     * Define the "admin" routes for the application.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
             ->middleware('web', 'auth.admin')
             ->namespace($this->namespace_user)
             ->group(base_path('routes/custom/admin.php'));
    }


    /**
     * Define the "appointments" routes for the application.
     *
     * @return void
     */
    protected function mapAppointmentsRoutes()
    {
        Route::prefix('appointments')
             ->middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/custom/appointments.php'));
    }


    /**
     * Define the "accounts" routes for the application.
     *
     * @return void
     */
    protected function mapAccountsRoutes()
    {
        Route::prefix('accounts')
             ->middleware('web')
             ->namespace($this->namespace_auth)
             ->group(base_path('routes/custom/accounts.php'));
    }

}
