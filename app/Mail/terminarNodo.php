<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//use Illuminate\Contracts\Queue\ShouldQueue;
//use Illuminate\Support\Facades\DB;

class terminarNodo extends Mailable{
	use Queueable, SerializesModels;

	public $actividad;
	public $proyecto;
	public $rut;
	public $nombre;
	public $apellido;
	public $id_dw;
	public $url;

	public function __construct($actividad, $proyecto, $rut, $nombre, $apellido, $url){
		$this->actividad = $actividad;
		$this->proyecto = $proyecto;
		$this->rut = $rut;
		$this->nombre = $nombre;
		$this->apellido = $apellido;
		$this->url = $url;
	}

	public function build(){
		$subject = $this->actividad . ' | ' . $this->proyecto . ' | ' . parseRUT($this->rut) . ' | ' . $this->nombre . ' ' . $this->apellido;

		return $this->subject($subject)->view('emails.terminarNodo')->with([ 'nodo' => $this->actividad, 'url' => $this->url ]);
	}
}
