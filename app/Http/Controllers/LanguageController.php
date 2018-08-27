<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{
    
    /**
     * Change the language of the user and save his settings
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function changeLanguage(Request $request)
	{
		$language = $request->input('language', config('app.fallback_locale'));

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

		return redirect()->back()->withInput();
	}

	public function getJavascriptLocale(Request $request, $locale) {
	    if (!in_array($locale, config('app.locales'))) {
	        $locale = config('app.fallback_locale');
	    }

	    // Add locale to the cache key
	    $json = \Cache::remember("lang-{$locale}.js", 0, function () use ($locale) {
	        $files   = glob(resource_path('lang/' . $locale . '/*.php'));
	        $strings = [];

	        foreach ($files as $file) {
	            $name = basename($file, '.php');
	            $strings[$name] = require $file;
	        }

	        return $strings;
	    });

	    $contents = 'window.translations = ' . json_encode($json, config('app.debug', false) ? JSON_PRETTY_PRINT : 0) . ';';
	    $response = \Response::make($contents, 200);
	    $response->header('Content-Type', 'application/javascript');

	    return $response;
	}

}
