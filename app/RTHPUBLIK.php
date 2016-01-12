<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RTHPUBLIK extends Model {

	protected $connection = 'pgsqlsde';

	protected $table = 'publik';
	protected $primaryKey = 'objectid';
	protected $fillable = [];
	protected $hidden = [];
	public $timestamps = false;

}
