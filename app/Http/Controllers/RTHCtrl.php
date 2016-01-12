<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RTHPUBLIK;
use App\RTHPRIVAT;
use DB;
use Illuminate\Http\Request;

class RTHCtrl extends Controller {
	public $table;
	public function __construct(){
		$this->middleware('auth');
		DB::enableQueryLog();
		$this->table = 'publik';
		$this->table_privat = 'privat';
	}

	public function RTHInformasi(){
		$kotbogor = RTHPUBLIK::orderBy('objectid','asc')->get();
		return view('rth.informasi')->with('kotbogor',$kotbogor);
	}

	public function RTHFormQuery(){

		$table = $this->table;
		$kelurahan = RTHPUBLIK::select($table.'.kelurahan')->distinct()->get();
		$jenis_rth = RTHPUBLIK::select($table.'.jenis_rth')->distinct()->get();
		$kelompok_rth = RTHPUBLIK::select($table.'.kelompok_rth')->distinct()->get();

		return view('rth.formRTHQuery')->with('kelurahan',$kelurahan)
		->with('jenis_rth',$jenis_rth)
		->with('kelompok_rth',$kelompok_rth);
	}

	public function RTHFormQueryPost(Request $request){
		$rth = ($request->rth == 'publik') ? $this->table : $this->table_privat ;
		$table = $rth;
		$DB = DB::connection('pgsqlsde')->table($table);
		$rkel = $request->kelurahan;
		$rjnstam = $request->jenistanaman;
		$rkelt = $request->keltanaman;
		$tahun = $request->tahun;
		$sorting = $request->sorting;
		$s = strtoupper($request->search);
		
		if ($rkel == null && $rjnstam == null && $rkel == null) {
			if (!empty($s)) {
				$sql = $DB->whereRaw('UPPER(nama_rth) like ?',array('%'.$s.'%'))->orderBy($sorting,'desc')->get();
			}else{
				$sql = $DB->orderBy($sorting,'desc')->get();
			}
			
		}else{
			$arr = [];
			$value_ = [];
			$sql_ = '';
			if (!empty($rkel)) {	
				array_push($arr, 'kelurahan');
				array_push($value_, $rkel);		
			}
			if (!empty($rjnstam)) {			
				array_push($arr, 'jenis_rth');
				array_push($value_, $rjnstam);		
			}
			if (!empty($rkelt)) {
				array_push($arr, 'kelompok_rth');
				array_push($value_, $rkelt);		
			}
			if (!empty($tahun)) {
				//
			}	
			foreach ($arr as $key => $value) {
				$retVal = ($key == 0) ? '' : 'or' ;
				$sql_ .= $retVal.' '.$value.' = ? ';
			}
			if (!empty($s)) {
				$sql = $DB->whereRaw('UPPER(nama_rth) like ?',array('%'.$s.'%'))->whereRaw($sql_,$value_)->get();
			}else{
				$sql = $DB->whereRaw($sql_,$value_)->get();
			}
			
		}
		//dd($sql);
		$kotbogor = $sql;
		
		return view('rth.formRTHQueryPost')->with('kotbogor',$kotbogor);
	}


	public function TitikList(){
		$kotbogor = RTHPUBLIK::orderBy('objectid','asc')->get();
		return view('rth.TitikList')->with('kotbogor',$kotbogor);

	}
	public function TitikAdd(){
		$table = $this->table;
		$rth_q = DB::connection('pgsqlsde')->table($table)
		->orderBy('objectid','desc')->lists('objectid');
		$objectid = $rth_q[0]+1;

		$kelurahan = RTHPUBLIK::select($table.'.kelurahan')->distinct()->get();
		$jenis_rth = RTHPUBLIK::select($table.'.jenis_rth')->distinct()->get();
		$kelompok_rth = RTHPUBLIK::select($table.'.kelompok_rth')->distinct()->get();
		
		return view('rth.TitikAdd')->with('objectid',$objectid)
			->with('kelurahan',$kelurahan)
			->with('jenis_rth',$jenis_rth)
			->with('kelompok_rth',$kelompok_rth);
	}
	public function TitikEdit($id){
		$table = $this->table;
		$titik = RTHPUBLIK::find($id);
		$kelurahan = RTHPUBLIK::select($table.'.kelurahan')->distinct()->get();
		$jenis_rth = RTHPUBLIK::select($table.'.jenis_rth')->distinct()->get();
		$kelompok_rth = RTHPUBLIK::select($table.'.kelompok_rth')->distinct()->get();
		return view('rth.TitikEdit')->with('titik',$titik)
			->with('kelurahan',$kelurahan)
			->with('jenis_rth',$jenis_rth)
			->with('kelompok_rth',$kelompok_rth);

	}

	public function TitikEditPost(Request $request){
		$file = $request->file('image_link');
		if(!empty($file)){
			$destinationPath = public_path('images').'/rth';
			$fileName = $file->getClientOriginalName();
			//$fileName = str_random(20) . '.' . $file->getClientOriginalExtension();
			$pathFilename = 'images/rth/'.$fileName;
		}
		$this->validate($request, [
            'nama_rth' => 'required', 
            'vegetasi' => 'required', 
            'furniture' => 'required',
            'tahun_survey' => 'required',
            'kepemilikan_lahan' => 'required',
        ]);
        
		$titik = RTHPUBLIK::find($request->objectid);
		//\File::delete($titik->image_link);
		$titik->nama_rth = $request->nama_rth;
		$titik->kelompok_rth = $request->kelompok_rth;
		$titik->kelurahan = $request->kelurahan;
		$titik->luas_m2 = $request->luas_m2;
		$titik->jenis_rth = $request->jenis_rth;
		
		if(!empty($file)){
			$file->move($destinationPath, $fileName);
			$titik->image_link = $pathFilename;
		}
		
		
		$titik->vegetasi = $request->vegetasi;
		$titik->furniture = $request->furniture;
		$titik->tahun_survey = $request->tahun_survey;
		$titik->kepemilikan_lahan = $request->kepemilikan_lahan;
		

		$titik->save();
		return redirect('rth-titik-list');
	}

	public function TitikDelete($id){
		$titik = RTHPUBLIK::find($id);
		$titik->delete();
		//return view('rth.TitikEdit')->with('titik',$titik);
		return redirect('rth-titik-list');
	}

	public function TitikPrivatList(){
		$privat = RTHPRIVAT::orderBy('objectid','asc')->get();
		return view('rth.TitikListPrivat')->with('privat',$privat);

	}

	public function TitikPrivatEdit($id){
		$table = $this->table_privat;
		$titik = RTHPRIVAT::find($id);
		$kelurahan = RTHPRIVAT::select($table.'.kelurahan')->distinct()->get();
		$jenis_rth = RTHPRIVAT::select($table.'.jenis_rth')->distinct()->get();
		$kelompok_rth = RTHPRIVAT::select($table.'.kelompok_rth')->distinct()->get();
		return view('rth.TitikPrivatEdit')->with('titik',$titik)
			->with('kelurahan',$kelurahan)
			->with('jenis_rth',$jenis_rth)
			->with('kelompok_rth',$kelompok_rth);

	}

	public function TitikPrivatEditPost(Request $request){
		$file = $request->file('image_link');
		if(!empty($file)){
			$destinationPath = public_path('images').'/rth';
			$fileName = $file->getClientOriginalName();
			//$fileName = str_random(20) . '.' . $file->getClientOriginalExtension();
			$pathFilename = 'images/rth/'.$fileName;
		}
		$this->validate($request, [
            'nama_rth' => 'required', 
            'vegetasi' => 'required', 
            'furniture' => 'required',
            'tahun_survey' => 'required',
            'kepemilikan_lahan' => 'required',
        ]);
        
		$titik = RTHPRIVAT::find($request->objectid);
		//\File::delete($titik->image_link);
		$titik->nama_rth = $request->nama_rth;
		$titik->kelompok_rth = $request->kelompok_rth;
		$titik->kelurahan = $request->kelurahan;
		$titik->luas_m2 = $request->luas_m2;
		$titik->jenis_rth = $request->jenis_rth;
		
		if(!empty($file)){
			$file->move($destinationPath, $fileName);
			$titik->image_link = $pathFilename;
		}
		
		
		$titik->vegetasi = $request->vegetasi;
		$titik->furniture = $request->furniture;
		$titik->tahun_survey = $request->tahun_survey;
		$titik->kepemilikan_lahan = $request->kepemilikan_lahan;
		

		$titik->save();
		return redirect('rth-titikprivat-list');
	}

	

	
}
