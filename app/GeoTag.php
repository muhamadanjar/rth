<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class GeoTag extends Model {
	protected $connection = 'pgsqlsde';
	protected $table = 'geotagging';
	protected $fillable = [];
	protected $hidden = ['objectid','shape'];
	protected $primaryKey = 'objectid';
	public $timestamps = false;

}