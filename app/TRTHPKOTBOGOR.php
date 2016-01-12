<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class TRTHPKOTBOGOR extends Model {

	protected $connection = 'pgsqlsde';
	protected $table = 'titik_rth_publik_kota_bogor';
	//protected $table = 'kotabogor';
	protected $primaryKey = 'objectid';
	protected $fillable = [];

	public $timestamps = false;

}
