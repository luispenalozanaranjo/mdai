<template>
<div>
	<div class="content-block">
		<div class="file-cont">
			<input type="file" id="cargar-planilla" @change="handleDrop" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"/>
			<label for="cargar-planilla" class="d-block py-32 px-32">
				<div class="d-flex align-items-center justify-content-center">
					<div class="mr-32">
						<span class="fa fa-upload f-40 text-normal"></span>
					</div>
					<div class="text-cont">
						<p class="f-large fw-semibold">Haz clic para buscar el archivo</p>
						<p>e importar las promesas a la plataforma.</p>
					</div>
				</div>
			</label>
		</div>
	</div>

	<div class="heading-block mt-32 mb-16" v-if="ingresados !== null">
		<h3 class="heading-3">Resultado</h3>
		<p v-if="ingresados.count">
			{{ ingresados.count }} registros cargados/actualizados correctamente.
		</p>
		<p v-if="!ingresados">No se importó ningún registro.</p>
	</div>

	<mdai-table v-if="ingresados && ingresados.count" :head="['RUT', 'Nombre', 'Estado', 'Fecha entrada', 'Tipo', 'Usuario encargado', 'Acciones']" :body="ingresados.data">
		<template slot-scope="{item}">
			<td>{{ item.rut_cliente | rut }}</td>
			<td>{{ (item.primer_nombre + " " + item.apellido_paterno) | capitalize }}</td>
			<td><mdai-status :id="item.estados.id" :estado="item.estados.descripcion"></mdai-status></td>
			<td v-text="item.fecha_promesa"></td>
			<td v-text="item.marca"></td>
			<td v-text="item.ejecutivo"></td>
			<td>
				<div class="row-actions">
					<a :href="route('clientes.detalles', item.rut_cliente)" target="_blank"><span class="fa fa-eye"></span></a>
				</div>
			</td>
		</template>
	</mdai-table>
</div>
</template>

<script>
import XLSX from "xlsx";

export default {
	data: function() {
		return {
			promesados: [],
			ingresados: null,
		};
	},
	methods: {
		handleDrop: function(e) {
			this.$store.commit("toggleAction");
			this.$store.commit("addActionText", "Leyendo planilla...");
			let file = e.target.files[0];
			setTimeout(() => {
				this.getJSON(file);
			}, 100);
		},
		getJSON: function(f) {
			let reader = new FileReader();

			reader.onload = (e) => {
				let data = new Uint8Array(e.target.result);
				let workbook = XLSX.read(data, { type: "array" });
				let sheetName = workbook.SheetNames[0];
				let worksheet = workbook.Sheets[sheetName];
				let new_data = XLSX.utils.sheet_to_json(worksheet, { defval: "" });
				let promesados = [];
				let allowed = ['Promesada', 'Escriturada', 'Desistida'];

				new_data.forEach(item => {
					// Solo promesas con ciertos estados y que tenga un email (required)
					if ( allowed.includes(item.Estado) && !this.$methods.checkNullEmpty(item.Email) ){
						promesados.push(item);
					}
				});

				this.promesados = promesados;
				this.sendData();
			};
			reader.readAsArrayBuffer(f);
		},
		enableToast: function(text, type) {
			this.$store.commit("enableToast", {
				text: text,
				type: type
			});
		},
		sendData: function() {
			let total = this.promesados.filter(item => item.estado !== 'Desistida').length;
			this.$store.commit("addActionText", `Cargando ${total} promesas...`);

			if( this.promesados.length ){
				// Hay promesados
				this.$http({
					method: "post",
					url: "/cargar-planilla",
					data: {
						promesados: this.promesados,
					},
				})
				.then(response => {
					let data = response.data;
					this.$store.commit("toggleAction");

					if( data ){
						// Se cargaron las promesas
						this.ingresados = data;
						this.enableToast("Promesas cargadas correctamente", "success");
					}
					else {
						// Ocurrió algo (error)
						this.enableToast("Ocurrió un problema al cargar las promesas", "error");
					}
				})
				.catch((error) => {
					// Errores del servidor
					console.error(error);
					setTimeout(() => {
						this.$store.commit("toggleAction");
						this.enableToast(
							"Ocurrió un problema al cargar las promesas",
							"error"
						);
					}, 500);
				});
			}
		}
	}
};
</script>
