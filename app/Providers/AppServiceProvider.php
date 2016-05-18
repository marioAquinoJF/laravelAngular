<?php

namespace larang\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use larang\Entities\ProjectTask;
use larang\Events\TaskWasIncluded;
use larang\Events\TaskWasUpdated;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ProjectTask::created(function($task) {
            Event::fire(new TaskWasIncluded($task));
        });
        ProjectTask::updated(function($task) {
            Event::fire(new TaskWasUpdated($task));
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

}
