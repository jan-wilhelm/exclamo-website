<?php

namespace App\Actions;

use Auth;

class ChangeLanguageAction
{

	public function execute(String $language)
	{
		// Default to the $defaultLanguage locale
		if(!in_array($language, config('app.locales'))) {
			$language = config('app.fallback_locale');
		}

		// Persist the language to the database
		if (Auth::check()) {
			Auth::user()->language = $language;
			Auth::user()->save();
		}

		session(['locale'=> $language]);
		app()->setLocale($language);

		return $language;
	}

}