<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Widget extends Model {

	protected $table = 'widget';
	protected $primaryKey = 'id_widget';

	public $timestamps = true;

}
