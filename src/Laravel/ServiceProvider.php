<?php

namespace jyj1993126\Bugly\Laravel;

use Illuminate\Support\ServiceProvider as laravelServiceProvider;
use jyj1993126\Bugly\Laravel\BuglyCommands;

/**
 * @author Leon J
 * @since 2017/2/23
 */
class ServiceProvider extends laravelServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/Config/bugly.php', 'bugly'
        );

        $this->app->singleton('Bugly', function ($app){
            return new Bugly(config('bugly.app_key'));
        });
    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/bugly.php' => config_path('bugly.php'),
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([ BuglyCommands::class ]);
        }
    }

}