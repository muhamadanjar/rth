<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\RTH;
use App\TRTHPKOTBOGOR; /* Titik RTH Publik Kota Bogor*/
use Illuminate\Http\Request;
use DB;


class Master extends Controller {

	public $MasterReportStore;
	function __construct($foo = null) {
		$this->foo = $foo;
		
		$this->middleware('auth');
		
	}


	public function ListDataRTH(){
		//$rth = new RTH();
		$table = 'titik_rth_publik_kota_bogor';
		$rth_q = DB::connection('pgsqlsde')->table($table)
		->select($table.'.nama_taman', 
  				$table.'.kelompok_taman', 
  				$table.'.kelurahan', 
  				$table.'.luas_m2', 
  				$table.'.jenis_taman'
  		)->get();
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->get();
		$jnstam = DB::connection('pgsqlsde')->table($table)
		->select($table.'.jenis_taman')->distinct()->get();
		$rthtitik = $rth_q;
		return view('master.RTH')->with('rthtitik',$rthtitik)->with('kelurahan',$kelurahan)->with('jnstam',$jnstam);
	}

	/*Titik RTH Publik Pemkot*/
	public function MasterTRTHPKOTBOGOR(){
		$table = 'kotabogor';
		$kotbogor = DB::connection('pgsqlsde')->table($table)->get();
		
		return view('master.TRTHPKOTBOGOR')->with('kotbogor',$kotbogor);
	}

	public function MasterAddTRTHPKOTBOGOR(){
		$table = 'kotabogor';
		$rth_q = DB::connection('pgsqlsde')->table($table)
		->orderBy('objectid','desc')->lists('objectid');
		$objectid = $rth_q[0]+1;
		//dd($objectid);
		return view('master.TRTHPKOTBOGORFormAdd')->with('objectid',$objectid);
	}

	public function MasterEditTRTHPKOTBOGOR($id){
		$table = 'kotabogor';
		$rth_q = DB::connection('pgsqlsde')->table($table)
		->whereRaw('objectid = ?',array($id))
		->orderBy('objectid','desc')->first();
		//dd($rth_q[0]);
		//dd($objectid);

		return view('master.TRTHPKOTBOGORFormEdit')->with('titik',$rth_q);
	}

	public function MasterDeleteTRTHPKOTBOGOR($id) {
		$table = 'kotabogor';
		$rth_q = DB::connection('pgsqlsde')->table($table)
		->whereRaw('objectid = ?',array($id));
		$rth_q->delete();
		//\File::delete(public_path('images/' . $post->image));

		return redirect('rth-titik-list');
	}

	public function MasterAddTRTHPKOTBOGORGetValue(Request $request){
		return $_GET;

	}

	public function MasterAddTRTHPKOTBOGORPOST(Request $request){
		if($request->ajax()){
			return $request;
		}
	}

	public function MasterReportForm(){

		$table = 'titik_rth_publik_kota_bogor';
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->get();
		$jnstam = DB::connection('pgsqlsde')->table($table)
		->select($table.'.jenis_taman')->distinct()->get();
		$kelompok_taman = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_taman')->distinct()->get();
		return view('master.ReportRthTitikForm')->with('kelompok_taman',$kelompok_taman)
		->with('kelurahan',$kelurahan)->with('jnstam',$jnstam);
	}

	public function MasterReport(Request $request){
		$table = 'titik_rth_publik_kota_bogor';
		$rkel = $request->kelurahan;
		$rjnstam = $request->jenistanaman;
		$rkelt = $request->keltanaman;
		//dd($rkel);
		if ($rkel == null && $rjnstam == null && $rkel == null) {
			$sql = DB::connection('pgsqlsde')->table($table)->get();
		}else{
			$arr = [];
			$value_ = [];
			$sql_ = '';
			if (!empty($rkel)) {
				
				array_push($arr, 'kelurahan');
				array_push($value_, $rkel);		
			}

			if (!empty($rjnstam)) {
				
				array_push($arr, 'jenis_taman');
				array_push($value_, $rjnstam);		
			}

			if (!empty($rkelt)) {
				array_push($arr, 'kelompok_taman');
				array_push($value_, $rkelt);		
			}	
			foreach ($arr as $key => $value) {
				$retVal = ($key == 0) ? '' : 'or' ;
				$sql_ .= $retVal.' '.$value.' = ? ';
			}
			//dd($sql_);
			
			
			$sql = DB::connection('pgsqlsde')->table($table)->whereRaw($sql_,$value_)->get();
		}
		//dd($sql);
		$kotbogor = $sql;

		$this->MasterReportStore = $kotbogor;
		$request->session()->put('MasterReportStore', $this->MasterReportStore);
		
		return view('master.ReportRthTitik')->with('kotbogor',$this->MasterReportStore);
	}

	public function MasterReportExcel($namafile){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		$objPHPExcel = new \PHPExcel();
		$kotbogor = session('MasterReportStore');
		//dd($kotbogor);
		$BorderstyleArray = array(
			'borders' => array(
			    'allborders' => array(
			      'style' => \PHPExcel_Style_Border::BORDER_THIN
			    )
			)
		);

		$ColorstyleArray = array(
	        'type' => \PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => 'F28A8C'
	        )
	    );

		/*$objPHPExcel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
	        'type' => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => $color
	        )
	    ));*/
		
		$objPHPExcel->setActiveSheetIndex(0)
	            ->setCellValue('B2', 'Laporan RTH Kota Bogor');
	    $objPHPExcel->getActiveSheet()->getStyle("B2")->getFont()->setSize(16);

		// Setting Ukuran
		$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
		

		// Setting Gambar
		$objDrawing = new \PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('Logo');
		$objDrawing->setDescription('Logo');
		$logo = 'images/kotabogor.png'; // Provide path to your logo file
		$objDrawing->setPath($logo);  //setOffsetY has no effect
		$objDrawing->setCoordinates('A1');
		$objDrawing->setHeight(80); // logo height
		$objDrawing->setWorksheet($objPHPExcel->getActiveSheet()); 

		//Setting Style
		$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->applyFromArray($BorderstyleArray);
		$objPHPExcel->getActiveSheet()->getStyle('A5:E5')->getFill()->applyFromArray($ColorstyleArray);

		$objPHPExcel->getProperties()->setCreator("Administrator")
							 ->setLastModifiedBy("Administrator")
							 ->setTitle("Laporan RTH Kota Bogor")
							 ->setSubject("RTH Kota Bogorr")
							 ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
							 ->setKeywords("rth kotabogor office 2007 openxml php")
							 ->setCategory("rth");
		// Add some data
		$posHeader = 5;
		$objPHPExcel->setActiveSheetIndex(0)
		            ->setCellValue('A'.$posHeader, 'Nama taman')
		            ->setCellValue('B'.$posHeader, 'Kelompok taman')
		            ->setCellValue('C'.$posHeader, 'Kelurahan')
		            ->setCellValue('D'.$posHeader, 'Luas (m^2)')
		            ->setCellValue('E'.$posHeader, 'Jenis taman');
		$pos = $posHeader + 1;
		foreach ($kotbogor as $key => $ktbog) {
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$pos,	$ktbog->nama_taman)
		            ->setCellValue('B'.$pos, 	$ktbog->kelompok_taman)
		            ->setCellValue('C'.$pos, 	$ktbog->kelurahan)
		            ->setCellValue('D'.$pos, 	$ktbog->luas_m2)
		            ->setCellValue('E'.$pos, 	$ktbog->jenis_taman);
		            $pos += 1; 
		}


		$objPHPExcel->getActiveSheet()->getStyle('A5:E'.($pos-1))->applyFromArray($BorderstyleArray);

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Laporan RTH Kota Bogor');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$this->Excel2003($namafile);

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		//$objWriter->save($namafile.'.xls');
		$request->session()->forget('MasterReportStore');
		
	}

	public function Excel2003($namafile){
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$namafile.'.xls"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
	}

	public function Excel2007($namafile){
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment;filename="'.$namafile.'.xlsx"');
		header('Cache-Control: max-age=0');
		// If you're serving to IE 9, then the following may be needed
		header('Cache-Control: max-age=1');

		// If you're serving to IE over SSL, then the following may be needed
		header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
		header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
		header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
		header ('Pragma: public'); // HTTP/1.0
	}


	public function MasterReportFormGrafik(){

		$table = 'titik_rth_publik_kota_bogor';
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->get();
		$jnstam = DB::connection('pgsqlsde')->table($table)
		->select($table.'.jenis_taman')->distinct()->get();
		$kelompok_taman = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_taman')->distinct()->get();
		return view('master.ReportRthTitikFormGrafik')->with('kelompok_taman',$kelompok_taman)
		->with('kelurahan',$kelurahan)->with('jnstam',$jnstam);
	}


	public function MasterReportGrafik(Request $request){

		$table = 'titik_rth_publik_kota_bogor';
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->lists('kelurahan');
		
		$kelompok_taman = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_taman')->distinct()->lists('kelompok_taman');

	
		$jenislaporan = $request->jenislaporan;
		if($jenislaporan == 'kelurahan'){

			$store_stringkl = '';
			$store_stringsum = '';
			$data = array();
			$dataroot = array();
			$datakolom =array();
			$datakolomroot = array();

				for ($i=0; $i < count($kelurahan); $i++) { 
					$sql[$i] = DB::connection('pgsqlsde')
					->select( DB::raw("SELECT  kelurahan,SUM(luas_m2) 
						FROM ".$table." WHERE kelurahan = '$kelurahan[$i]' GROUP BY kelurahan") );
					foreach ($sql[$i] as $key => $kl) {
						
						$data[$i][0] = $kl->kelurahan;
						$data[$i][1] = $kl->sum;
						$datakolom[$i]['kelompok_taman'] = $kl->kelurahan;
						$datakolom[$i]['sum'] = $kl->sum;
						
						$coma = ($key ==0) ? '' : ',' ;
						$store_stringkl .= $coma.$kl->kelurahan;
						$store_stringsum .= $coma.$kl->sum;
					

					}		
				}
			$data_request = json_encode($datakolom);
			$dataroot['label'] = 'Taman Ruang Terbuka';
			$dataroot['color'] = '#28d8b2';		
			$dataroot['data'] = $data;
			$raw =array($dataroot);
			//return json_encode($this->chardatabar());
			//$request->session()->put('MasterReportStore', $raw);
			//return json_encode($raw);
			
		}else{
				
			$store_stringkl = '';
			$store_stringsum = '';
			$data = array();
			$dataroot = array();
			$datakolom =array();
			$datakolomroot = array();

				for ($i=0; $i < count($kelompok_taman); $i++) { 
					$sql[$i] = DB::connection('pgsqlsde')
					->select( DB::raw("SELECT  kelompok_taman,SUM(luas_m2) 
						FROM ".$table." WHERE kelompok_taman = '$kelompok_taman[$i]' GROUP BY kelompok_taman") );
					foreach ($sql[$i] as $key => $kl) {
						
						$data[$i][0] = $kl->kelompok_taman;
						$data[$i][1] = $kl->sum;
						$datakolom[$i]['kelompok_taman'] = $kl->kelompok_taman;
						$datakolom[$i]['sum'] = $kl->sum;
						
						$coma = ($key ==0) ? '' : ',' ;
						$store_stringkl .= $coma.$kl->kelompok_taman;
						$store_stringsum .= $coma.$kl->sum;
					

					}		
				}
			$data_request = json_encode($datakolom);
			$dataroot['label'] = 'Taman Ruang Terbuka';
			$dataroot['color'] = '#28d8b2';		
			$dataroot['data'] = $data;
			$raw =array($dataroot);
			//return json_encode($this->chardatabar());
			//$request->session()->put('MasterReportStore', $raw);
			//return json_encode($raw);
		}
		
		
		return view('master.ReportRthTitikGrafik')->with('data_request',$data_request);
	}

	public function chardatabarPost(){
		$data = session()->get('MasterReportStore');
		return json_encode($data);
	}

	public function chardatabar(){
		$data = array(
		    array(
		     	'label' => 'Sales',
		     	'color' => '#28d8b2',
		     	'data'  =>array(
		           array('Jan', 27),
		           array('Feb', 82),
		           array('Mar', 56),
		           array('Apr', 14),
		           array('May', 28),
		           array('Jun', 77),
		           array('Jul', 23),
		           array('Aug', 49),
		           array('Sep', 81),
		           array('Oct', 20)
		        )
		   	)
		);

		echo json_encode($data);
	}

	public function MasterReportGrafikHCData(Request $request){
		$table = 'titik_rth_publik_kota_bogor';
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->lists('kelurahan');
		
		$kelompok_taman = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_taman')->distinct()->lists('kelompok_taman');

		$jenislaporan = $request->jenislaporan;
		
		$array = array();
		$new = array();
		if ($jenislaporan == 'jenistaman'){
			foreach ($kelompok_taman as $key => $value) {
				unset($array);
				
					$sql = DB::connection('pgsqlsde')
					->select( DB::raw("SELECT  kelompok_taman,SUM(luas_m2) 
						FROM ".$table." WHERE kelompok_taman = '$value' GROUP BY kelompok_taman") );
					$array['data'][] = $sql[0]->sum;
					$array['name'][] = $sql[0]->kelompok_taman;
				
				
				array_push($new, $array);
			}
		}else{
			foreach ($kelurahan as $key => $value) {
				unset($array);
				
					$sql = DB::connection('pgsqlsde')
					->select( DB::raw("SELECT  kelurahan,SUM(luas_m2) 
						FROM ".$table." WHERE kelurahan = '$value' GROUP BY kelurahan") );
					$array['data'][] = $sql[0]->sum;
					$array['name'][] = $sql[0]->kelurahan;
				
				
				array_push($new, $array);
			}
		}

		return view('master.ReportRthTitikGrafikHCView')->with('json',json_encode($new,JSON_NUMERIC_CHECK));
		
	}
	public function MasterReportGrafikHC()
	{
		return view('master.ReportRthTitikGrafikHC');
	}
	



}
