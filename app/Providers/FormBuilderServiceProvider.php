<?php

namespace App\Providers;

use App\Http\Middleware\FormAllowSubmissionEdit;
use App\Http\Middleware\PublicFormAccess;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
	/**
	 * Register bindings in the container.
	 *
	 * @return void
	 */
	public function register()
	{
	    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'formbuilder');
	}

	/**
	 * Perform post-registration booting of services.
	 *
	 * @return void
	 */
	public function boot()
	{
	    // register the middleware
	    Route::aliasMiddleware('public-form-access', PublicFormAccess::class);
	    Route::aliasMiddleware('submisson-editable', FormAllowSubmissionEdit::class);
	}
}
