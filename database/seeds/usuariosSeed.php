<?php

use Illuminate\Database\Seeder;
use App\Usuario;

class usuariosSeed extends Seeder{

	public function run(){
		Usuario::insert([
			[
				'usuario' => 'admin',
				'password' => bcrypt('admin'),
				'nombres' => 'Admin',
				'apellidos' => 'MDAI',
				'rut' => 0,
				'id_cargo' => 15,
				'usuario_vivesoft' => NULL,
				'id_area' => 5,
				'backup' => NULL,
				'email' => 'clientepruebasmdai@gmail.com',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'aalvarez',
				'password' => bcrypt('aalvarez'),
				'nombres' => 'Andrea Carolina',
				'apellidos' => 'Alvarez de la Rivera Kater',
				'rut' => addDV(16608070),
				'id_cargo' => 1,
				'usuario_vivesoft' => NULL,
				'id_area' => 1,
				'backup' => NULL,
				'email' => 'aalvarez@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'ffigueroa',
				'password' => bcrypt('ffigueroa'),
				'nombres' => 'Felipe',
				'apellidos' => 'Figueroa Avendaño',
				'rut' => addDV(16363938),
				'id_cargo' => 2,
				'usuario_vivesoft' => NULL,
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'ffigueroa@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'voropeza',
				'password' => bcrypt('voropeza'),
				'nombres' => 'Veruska Karla',
				'apellidos' => 'Oropeza Montell',
				'rut' => addDV(26746477),
				'id_cargo' => 3,
				'usuario_vivesoft' => NULL,
				'id_area' => 3,
				'backup' => NULL,
				'email' => 'voropeza@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'ysaavedra',
				'password' => bcrypt('ysaavedra'),
				'nombres' => 'Yara Tibisay',
				'apellidos' => 'Saavedra Ferrer',
				'rut' => addDV(26083144),
				'id_cargo' => 3,
				'usuario_vivesoft' => NULL,
				'id_area' => 3,
				'backup' => NULL,
				'email' => 'ysaavedra@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'bsilva',
				'password' => bcrypt('bsilva'),
				'nombres' => 'Belkis Carolina',
				'apellidos' => 'Silva Arteaga',
				'rut' => addDV(25849481),
				'id_cargo' => 3,
				'usuario_vivesoft' => NULL,
				'id_area' => 3,
				'backup' => NULL,
				'email' => 'bsilva@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'kpena',
				'password' => bcrypt('kpena'),
				'nombres' => 'Karina Magdalena',
				'apellidos' => 'Peña Herrera',
				'rut' => addDV(12464685),
				'id_cargo' => 4,
				'usuario_vivesoft' => 'Karina Peña',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'kpena@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'dfuentes',
				'password' => bcrypt('dfuentes'),
				'nombres' => 'Daniela',
				'apellidos' => 'Fuentes Fuentes',
				'rut' => addDV(18295787),
				'id_cargo' => 5,
				'usuario_vivesoft' => NULL,
				'id_area' => 4,
				'backup' => NULL,
				'email' => 'dfuentes@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mmendoza',
				'password' => bcrypt('mmendoza'),
				'nombres' => 'María Francisca',
				'apellidos' => 'Mendoza Fuentes',
				'rut' => addDV(19169003),
				'id_cargo' => 6,
				'usuario_vivesoft' => 'María Francisca Mendoza',
				'id_area' => 5,
				'backup' => NULL,
				'email' => 'mmendoza@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'gguerra',
				'password' => bcrypt('gguerra'),
				'nombres' => 'Genesis del Carmen',
				'apellidos' => 'Guerra Páez',
				'rut' => addDV(26457560),
				'id_cargo' => 7,
				'usuario_vivesoft' => 'Genesis Guerra',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'gguerra@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'rpuschel',
				'password' => bcrypt('rpuschel'),
				'nombres' => 'Rocío del Pilar',
				'apellidos' => 'Puschel Briones',
				'rut' => addDV(17553137),
				'id_cargo' => 7,
				'usuario_vivesoft' => 'Rocio Puschel',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'rpuschel@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'carancibia',
				'password' => bcrypt('carancibia'),
				'nombres' => 'Cristian Andres',
				'apellidos' => 'Arancibia Valenzuela',
				'rut' => addDV(12464345),
				'id_cargo' => 8,
				'usuario_vivesoft' => NULL,
				'id_area' => 5,
				'backup' => NULL,
				'email' => 'carancibia@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'jastudillo',
				'password' => bcrypt('jastudillo'),
				'nombres' => 'Jorge Francisco',
				'apellidos' => 'Astudillo Valdes',
				'rut' => addDV(17225359),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Jorge Astudillo',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'jastudillo@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'sdamian',
				'password' => bcrypt('sdamian'),
				'nombres' => 'Soledad Andrea',
				'apellidos' => 'Damian Varas',
				'rut' => addDV(17962657),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Soledad Damian',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'sdamian@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'vgarrido',
				'password' => bcrypt('vgarrido'),
				'nombres' => 'Violeta Mercedes',
				'apellidos' => 'Garrido Antillanca',
				'rut' => addDV(11453823),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Violeta Garrido',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'vgarrido@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'dlira',
				'password' => bcrypt('dlira'),
				'nombres' => 'David Alejandro',
				'apellidos' => 'Lira Varas',
				'rut' => addDV(18317822),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'David LIra',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'dlira@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'dmiranda',
				'password' => bcrypt('dmiranda'),
				'nombres' => 'Diego Francisco',
				'apellidos' => 'Miranda Soto',
				'rut' => addDV(17651652),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Diego Miranda',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'dmiranda@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'iormazabal',
				'password' => bcrypt('iormazabal'),
				'nombres' => 'Isabel del Carmen',
				'apellidos' => 'Ormazabal Quinteros',
				'rut' => addDV(13032034),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Isabel Ormazabal',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'iormazabal@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mrodriguez',
				'password' => bcrypt('mrodriguez'),
				'nombres' => 'Miriam Haidee',
				'apellidos' => 'Rodriguez Farias',
				'rut' => addDV(25826409),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Mirian Rodriguez',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'mrodriguez@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'lsolis',
				'password' => bcrypt('lsolis'),
				'nombres' => 'Lynette Pamela',
				'apellidos' => 'Solis Astelli',
				'rut' => addDV(13428329),
				'id_cargo' => 9,
				'usuario_vivesoft' => 'Lynette Solis',
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'lsolis@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mdominguez',
				'password' => bcrypt('mdominguez'),
				'nombres' => 'Maria Cecilia',
				'apellidos' => 'Dominguez Bastian',
				'rut' => addDV(9313793),
				'id_cargo' => 10,
				'usuario_vivesoft' => NULL,
				'id_area' => 6,
				'backup' => 27,
				'email' => 'mdominguez@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => '1'
			],
			[
				'usuario' => 'dhirsh',
				'password' => bcrypt('dhirsh'),
				'nombres' => 'David Felipe',
				'apellidos' => 'Hirsh Vainstein',
				'rut' => addDV(8669210),
				'id_cargo' => 11,
				'usuario_vivesoft' => NULL,
				'id_area' => 3,
				'backup' => NULL,
				'email' => 'dhirsh@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => '1'
			],
			[
				'usuario' => 'ssoto',
				'password' => bcrypt('ssoto'),
				'nombres' => 'Sandra del Carmen',
				'apellidos' => 'Soto Lecaros',
				'rut' => addDV(8825352),
				'id_cargo' => 12,
				'usuario_vivesoft' => NULL,
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'ssoto@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mbustamante',
				'password' => bcrypt('mbustamante'),
				'nombres' => 'Macarena Teresa',
				'apellidos' => 'Bustamante Valenzuela',
				'rut' => addDV(17600341),
				'id_cargo' => 13,
				'usuario_vivesoft' => 'Macarena Bustamente',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'mbustamante@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'jirribarra',
				'password' => bcrypt('jirribarra'),
				'nombres' => 'Jaime Francisco',
				'apellidos' => 'Irribarra Espinosa',
				'rut' => addDV(13904627),
				'id_cargo' => 14,
				'usuario_vivesoft' => 'Jaime Irribarra',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'jirribarra@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mriquelme',
				'password' => bcrypt('mriquelme'),
				'nombres' => 'Maria Jose',
				'apellidos' => 'Riquelme Dominguez',
				'rut' => addDV(17810418),
				'id_cargo' => 15,
				'usuario_vivesoft' => 'María José Riquelme',
				'id_area' => 2,
				'backup' => 24,
				'email' => 'mriquelme@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'sparada',
				'password' => bcrypt('sparada'),
				'nombres' => 'Sandra Patricia',
				'apellidos' => 'Parada Contreras',
				'rut' => addDV(9898542),
				'id_cargo' => 16,
				'usuario_vivesoft' => NULL,
				'id_area' => 6,
				'backup' => NULL,
				'email' => 'sparada@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'mespinoza',
				'password' => bcrypt('mespinoza'),
				'nombres' => 'Marlene Gema',
				'apellidos' => 'Espinoza Pezzopane',
				'rut' => addDV(9671821),
				'id_cargo' => 17,
				'usuario_vivesoft' => NULL,
				'id_area' => 3,
				'backup' => NULL,
				'email' => 'mespinoza@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			],
			[
				'usuario' => 'adelbino',
				'password' => bcrypt('adelbino'),
				'nombres' => 'Ana Carolina',
				'apellidos' => 'Del Bino Cortes',
				'rut' => addDV(21880891),
				'id_cargo' => 18,
				'usuario_vivesoft' => 'Ana Del Bino',
				'id_area' => 2,
				'backup' => NULL,
				'email' => 'adelbino@mdai.cl',
				'rol' => NULL,
				'perfil' => NULL,
				'vacaciones' => "0",
				'fecha_desde' => NULL,
				'fecha_hasta' => NULL,
				'created_at' => dateNow(),
				'representante_legal' => NULL
			]
		]);
	}
	
}