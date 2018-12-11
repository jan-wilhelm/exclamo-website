<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Actions\ChangeLanguageAction;

class LanguageController extends Controller
{
    
    /**
     * Change the language of the user and save his settings
     */
	public function changeLanguage(Request $request, ChangeLanguageAction $action)
	{
		$language = $request->input('language');
		$action->execute($language);
		return redirect()->back()->withInput();
	}

	public function getJavascriptLocale(Request $request, $locale) {
	    if (!in_array($locale, config('app.locales'))) {
	        $locale = config('app.fallback_locale');
	    }

	    // Add locale to the cache key
	    // TODO change the cache constant
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
