<?php

namespace Laramie\Admin;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
	/**
	 * @var array
	 */
	protected $commands = [
		'Laramie\Admin\Console\Commands\InstallCommand',
	];

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
		if (file_exists($routes = base_path() . '/routes/backend.php')) {
			$this->loadRoutesFrom($routes);
            echo 'loadRoutes!';
        } else {
            echo 'foobar';
		}

		if ($this->app->runningInConsole()) {
			$this->publishes([__DIR__ . '/../config' => config_path()], 'laramie-config');
			$this->publishes([ __DIR__ . '/../database/migrations' => database_path('migrations') ], 'laramie-migrations');
			$this->publishes([ __DIR__ . '/../public' => public_path()], 'laramie-assets');

			// $this->publishes([ __DIR__ . '/Http/Controllers' => app_path('Http/Controllers')], 'laramie-controllers');
		}

		$this->commands($this->commands);
	}

	/**
	 * Register any package services.
	 *
	 * @return void
	 */
	public function register()
	{
		// $this->mergeConfigFrom(__DIR__ . '/../config/admin.php', 'laramie-config');
	}
}