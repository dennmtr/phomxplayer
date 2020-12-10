<?php

namespace phOMXPlayer\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class OMXPlayerServiceProvider extends BaseServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{

		$this->mergeConfigFrom($this->configPath(), 'phomxplayer');

	}

	/**
	 * Set the config path
	 *
	 * @return string
	 */
	protected function configPath()
	{
		return __DIR__ . '/../../config/phomxplayer.php';
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([

			// Config

			$this->configPath() => config_path('phomxplayer.php'),

		], 'phOMXPlayer');
	}

}
