<?php

namespace larang\Providers;

use Illuminate\Support\ServiceProvider;

class CodeProjectRepositoryProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                \larang\Repositories\ClientRepository::class, \larang\Repositories\ClientRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\ProjectRepository::class, \larang\Repositories\ProjectRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\ProjectNoteRepository::class, \larang\Repositories\ProjectNoteRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\ProjectFileRepository::class, \larang\Repositories\ProjectFileRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\ProjectTaskRepository::class, \larang\Repositories\ProjectTaskRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\ProjectMemberRepository::class, \larang\Repositories\ProjectMemberRepositoryEloquent::class
        );
        $this->app->bind(
                \larang\Repositories\UserRepository::class, \larang\Repositories\UserRepositoryEloquent::class
        );
    }

}
