<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Almacen extends Model{
	protected $table = 'almacen_datos';
	protected $fillable = ['slug', 'nombre', 'type'];
	public $timestamps = false;
}