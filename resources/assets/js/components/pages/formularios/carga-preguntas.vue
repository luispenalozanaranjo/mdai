<template>
	<div>
		<div class="content-block">
			<form class="form" ref="form">
				<div class="file-cont">
					<input type="file" id="cargar-planilla" name="planilla" @change="handleDrop" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
					<label for="cargar-planilla" class="d-block box py-60 px-30">
						<div class="d-flex align-items-center justify-content-center">
							<div class="mr-30">
								<span class="fa fa-upload f-40 text-normal"></span>
							</div>
							<div class="text-cont">
								<p class="f-large fw-semibold">Haz click para buscar el archivo</p>
								<p>y generar el array con las preguntas.</p>
							</div>
						</div>
					</label>
				</div>
			</form>
		</div>

		<div class="content-block" v-if="makeArray">
			<ul>
				<li v-for="(pregunta, index) in preguntas" :key="index">
					[
						'num_pregunta' => {{ pregunta.num_pregunta }},
						'marca_campo' => {{ (pregunta.marca_campo) ? "'" + pregunta.marca_campo + "'" : 'NULL' }},
						'configuracion' => {{ (pregunta.configuracion) ? "'" + pregunta.configuracion + "'" : 'NULL' }},
						'tipo' => {{ (pregunta.tipo) ? "'" + pregunta.tipo + "'" : 'NULL' }},
						'encabezado_pregunta' => '{{ pregunta.encabezado_pregunta }}',
						'id_form' => {{ pregunta.id_form }},
						'requerido' => {{ pregunta.requerido }},
					],
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
	import XLSX from 'xlsx';

	export default{
		data: function(){
			return {
				preguntas: [],
				makeArray: false
			};
		},
		methods: {
			handleDrop: function(e){
				this.$store.commit('toggleAction');
				this.$store.commit('addActionText', 'Leyendo planilla...');

				var f = e.target.files[0];

				setTimeout(() => {
					this.getJSON(f);
				}, 100);
			},
			getJSON: function(f){
				var reader = new FileReader();

				reader.onload = (e) => {
					var data = new Uint8Array(e.target.result);
					var workbook = XLSX.read(data, {type: 'array'});
					let sheetName = workbook.SheetNames[0];
					let worksheet = workbook.Sheets[sheetName];
					let new_data = XLSX.utils.sheet_to_json(worksheet, {defval: ""});
					let preguntas = [];

					new_data.forEach((item, index) => {
						preguntas.push({
							num_pregunta: item.num_pregunta,
							marca_campo: item.marca_campo,
							configuracion: item.configuracion,
							encabezado_pregunta: item.encabezado_pregunta,
							id_form: item.id_form,
							tipo: item.tipo,
							requerido: item.requerido
						});
					});

					this.preguntas = preguntas;
					this.makeArray = true;
					this.$store.commit('toggleAction');
					
				};
				reader.readAsArrayBuffer(f);
			}
		}
	}
</script>