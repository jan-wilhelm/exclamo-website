<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LanguageController extends Controller
{

	protected $languages = [
		"de",
		"en"
	];

	protected $defaultLanguage = "en";
    
    /**
     * Change the language of the user and save his settings
     * @param  Request $request [description]
     * @return [type]           [description]
     */
	public function changeLanguage(Request $request)
	{
		$language = $request->input('language', $this->defaultLanguage);

		// Default to the $defaultLanguage locale
		if(!in_array($language, $this->languages)) {
			$language = $this->$defaultLanguage;
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

}
