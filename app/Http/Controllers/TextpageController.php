<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TextpageController extends Controller
{
	/**
	* szöveges oldal megjelenitő
	* a megjelenitendő szöveget a {name}" URL paraméter adja meg:
	* ha  resources/lang/{actLanguage}/{name}.html létezik akkor ennek tartalma,
	* ha itt nem tallja akkor resources/lang/en/{name}.html tartalma
	* @param Request $request 
	* @param string $name
	* @return string full HTML page
	*/	
	public function show(Request $request, $name = '?') {
		$fname = base_path().'/resources/lang/'.\Lang::locale().'/'.$name.'.html';
		if (!file_exists($fname)) {
			$fname = base_path().'/resources/lang/en/'.$name.'.html';
		}
		if (file_exists($fname)) {
			$result = view('textpage',["fname" => $fname]);
		} else {	
			$result = 'Fatal error '.$fname.' not found';
		}		
		return $result;	
	}
}
