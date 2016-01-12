<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RTHPRIVAT extends Model {

	protected $connection = 'pgsqlsde';

	protected $table = 'privat';
	protected $primaryKey = 'objectid';
	protected $fillable = [];
	protected $hidden = [];
	public $timestamps = false;

}
