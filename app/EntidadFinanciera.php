<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntidadFinanciera extends Model{
	use SoftDeletes;

    public $table = 'entidades_financieras';
    protected $fillable = ['entidad', 'tipo', 'estado'];
}
