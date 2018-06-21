<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{

	protected $languages = [
		"de",
		"en"
	];

	protected $defaultLanguage = "en";
    
	public function changeLanguage(Request $request)
	{
		$language = $request->input('language', $this->defaultLanguage);

		if(!in_array($language, $this->languages)) {
			$language = $this->$defaultLanguage;
		}

		session(['locale'=> $language]);
		app()->setLocale($language);

		//return session('locale');
		return redirect()->back()->withInput();
	}

}
