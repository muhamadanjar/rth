<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Http\Request;
use DB;
class ReportCtrl extends Controller {

	public function __construct(){
		$this->middleware('auth');
		$this->middleware('roleuser');
		$this->table = 'publik';
		$this->table_privat = 'privat';
	}

	public function index()
	{
		//
	}


	public function create()
	{
		//
	}


	public function store()
	{
		//
	}


	public function show($id)
	{
		//
	}


	public function edit($id)
	{
		//
	}


	public function update($id)
	{
		//
	}


	public function destroy($id)
	{
		//
	}

	public function ReportForm(){

		$table = $this->table;
		$kelurahan = DB::connection('pgsqlsde')->table('kelurahan')
		->select('kelurahan'.'.kelurahan')->orderBy('kelurahan','asc')->get();
		$jenis_rth = DB::connection('pgsqlsde')->table($table)
		->select($table.'.jenis_rth')->distinct()->get();
		$kelompok_rth = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_rth')->distinct()->get();
		
		return view('report.ReportRthTitikForm')->with('kelompok_rth',$kelompok_rth)
		->with('kelurahan',$kelurahan)->with('jenis_rth',$jenis_rth);
	}

	public function ReportFormPost(Request $request){
		$rth = ($request->rth == 'publik') ? $this->table : $this->table_privat ;
		$table = $rth;
		$rkel = $request->kelurahan;
		$rjnstam = $request->jenis_rth;
		$rkelt = $request->kelompok_rth;
		//dd($rkelt);
		if ($rkel == null && $rjnstam == null && $rkel == null) {
			$_sql = DB::connection('pgsqlsde')->table($table);
			$total = $_sql->sum('luas_m2');
			$sql = $_sql->get();
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
			foreach ($arr as $key => $value) {
				$retVal = ($key == 0) ? '' : 'and' ;
				$sql_ .= $retVal.' '.$value.' = ? ';
			}
			//dd($value_);
			$_sql = DB::connection('pgsqlsde')->table($table)->whereRaw($sql_,$value_); 
			$total = $_sql->sum('luas_m2');
			$sql = $_sql->get();
		}
		//dd($sql);
		$kotbogor = $sql;
		//dd($kotbogor);
		$this->MasterReportStore = $kotbogor;
		Session::put('ReportStore', $kotbogor);
		//$request->session()->put('ReportStore', $this->MasterReportStore);
		$request->session()->put('total', $total);

		
		return view('report.ReportRTH')->with('kotbogor',$this->MasterReportStore)->with('total',$total);
	}

	public function ReportGrafikHC(){
		return view('report.ReportRTHGrafik');
	}

	public function ReportGrafikHCPost(Request $request){
		$rth = ($request->rth == 'publik') ? $this->table : $this->table_privat ;
		$table = $rth;
		$kelurahan = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelurahan')->distinct()->lists('kelurahan');
		
		$kelompok_rth = DB::connection('pgsqlsde')->table($table)
		->select($table.'.kelompok_rth')->distinct()->lists('kelompok_rth');

		$jenislaporan = $request->jenislaporan;
		
		$array = array();
		$new = array();
		if ($jenislaporan == 'jenis_rth'){
			foreach ($kelompok_rth as $key => $value) {
				unset($array);
				
					$sql = DB::connection('pgsqlsde')
					->select( DB::raw("SELECT  kelompok_rth,SUM(luas_m2) 
						FROM ".$table." WHERE kelompok_rth = '$value' GROUP BY kelompok_rth") );
					$array['data'][] = $sql[0]->sum;
					$array['name'][] = $sql[0]->kelompok_rth;
				
				
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

		return view('report.ReportRTHGrafikView')->with('jenislaporan',$jenislaporan)->with('json',json_encode($new,JSON_NUMERIC_CHECK));
		
	}

	public function ReportExcel($namafile){
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		

		if (PHP_SAPI == 'cli')
			die('This example should only be run from a Web Browser');
		$objPHPExcel = new \PHPExcel();
		$kotbogor = Session::get('ReportStore');
		//dd($kotbogor);
		//dd(Session::all());
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
		            ->setCellValue('A'.$posHeader, 'Nama rth')
		            ->setCellValue('B'.$posHeader, 'Kelompok rth')
		            ->setCellValue('C'.$posHeader, 'Kelurahan')
		            ->setCellValue('D'.$posHeader, 'Jenis rth')
		            ->setCellValue('E'.$posHeader, 'Luas (m2)');
		$pos = $posHeader + 1;
		foreach ($kotbogor as $key => $ktbog) {
			$objPHPExcel->setActiveSheetIndex(0)
					->setCellValue('A'.$pos,	$ktbog->nama_rth)
		            ->setCellValue('B'.$pos, 	$ktbog->kelompok_rth)
		            ->setCellValue('C'.$pos, 	$ktbog->kelurahan)
		            ->setCellValue('D'.$pos, 	$ktbog->jenis_rth)
		            ->setCellValue('E'.$pos, 	$ktbog->luas_m2);
		            
		            $pos += 1; 
		}
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('D'.$pos,'Total');
		$objPHPExcel->setActiveSheetIndex(0)->setCellValue('E'.$pos,Session::get('total'));


		$objPHPExcel->getActiveSheet()->getStyle('A5:E'.($pos-1))->applyFromArray($BorderstyleArray);

		// Rename worksheet
		$objPHPExcel->getActiveSheet()->setTitle('Laporan RTH Kota Bogor');

		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$objPHPExcel->setActiveSheetIndex(0);

		$this->Excel2003($namafile);

		$objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		//$objWriter->save($namafile.'.xls');
		//$request->session()->forget('ReportStore');
		$request->session()->forget('total');
		
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

}
