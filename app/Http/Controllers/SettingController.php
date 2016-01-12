<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Layer;
use DB;
use Illuminate\Http\Request;

class SettingController extends Controller {

	public function gantihost($value=''){
		return view('master.GantiHostLayer');
	}

	public function gantihostPost($value=''){
		$layers = DB::table('Layers')->lists('layerurl');
		$find = (string)trim(\Input::get('urlawal'));
		$replace = (string)trim(\Input::get('urlbaru'));
		foreach ($layers as $key => $layer) {
			var_dump($layer);
			if (strpos($layer, $find) > 0) {
				$newstring = str_replace($find, 'local', $layer);
			    echo $newstring.$find." ".$replace;
			    break;
			}
		    
		}
		//print_r($txt);
		//return $layer;
	}

}
