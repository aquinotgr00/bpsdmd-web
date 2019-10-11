<?php

namespace App\Providers;

use App\Entities;
use EntityManager;
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

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $bindToEntityOr404 = function ($class, $findKey = 'id', $condition = false) {
            return function ($value) use ($class, $findKey, $condition) {
                $entity = EntityManager::getRepository($class)->findOneBy([$findKey => $value]);

                if ($entity instanceof $class) {
                    if ($condition) {
                        if ($condition == Entities\Organization::TYPE_SUPPLY || $condition == Entities\Organization::TYPE_DEMAND) {
                            if ($entity->getType() == $condition) {
                                return $entity;
                            }
                        }
                    } else {
                        return $entity;
                    }
                }

                return abort(404);
            };
        };

        Route::bind('user', $bindToEntityOr404(Entities\User::class));
        Route::bind('org', $bindToEntityOr404(Entities\Organization::class));
        Route::bind('org_supply', $bindToEntityOr404(Entities\Organization::class), 'id', Entities\Organization::TYPE_SUPPLY);
        Route::bind('org_demand', $bindToEntityOr404(Entities\Organization::class), 'id', Entities\Organization::TYPE_DEMAND);
        Route::bind('program', $bindToEntityOr404(Entities\StudyProgram::class));
        Route::bind('student', $bindToEntityOr404(Entities\Student::class));
        Route::bind('teacher', $bindToEntityOr404(Entities\Teacher::class));
        Route::bind('employee', $bindToEntityOr404(Entities\Employee::class));
        Route::bind('license', $bindToEntityOr404(Entities\License::class));
        Route::bind('feeder', $bindToEntityOr404(Entities\Teacher::class));
        Route::bind('diklat', $bindToEntityOr404(Entities\Diklat::class));
        Route::bind('data_diklat', $bindToEntityOr404(Entities\DataDiklat::class));
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
}
