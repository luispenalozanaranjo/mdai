<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comision extends Model{
        protected $table = 'comisiones';
        protected $fillable = ['nodo', 'opp', 'estado'];
}
