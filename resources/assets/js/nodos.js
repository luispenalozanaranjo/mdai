import Axios from "axios";
import route from "ziggy";
import methods from "./methods";
import store from "./store";

export default {
	terminarActividad: function(info_nodo, cb) {
		return Axios({
			url: route("nodo.terminar"),
			method: "post",
			data: info_nodo,
		})
		.then(function(response) {
			var response = response.data;
			if (response === true) {
				// Esta todo bien, redireccionamos
				console.info("Actividad terminada");
				cb();
			} else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
	terminarExcepcion: function(info_excepcion, cb) {
		return Axios({
			url: route("excepcion.terminar"),
			method: "post",
			data: info_excepcion,
		})
		.then(function(response) {
			var response = response.data;
			if (response === true) {
				// Esta todo bien, redireccionamos
				console.info("Actividad terminada");
				cb();
			} else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
	getAlmacen: function(arr, cb) {
		// Retorna un objeto con los campos solicitados
		return Axios.get(route("almacen.get", arr)).then((response) => {
			cb(response.data);
		});
	},
	saveDetallesSimple: function(fields) {
		// Guarda los campos en la base de datos
		store.mutations.toggleAction(store.state);
		store.mutations.addActionText(store.state, "Guardando cambios...");

		return Axios({
			url: route("datos.save"),
			method: "post",
			data: fields,
		});
	},
	saveDetalles: function(fields, cb) {
		// Guarda los campos en la base de datos
		store.mutations.toggleAction(store.state);
		store.mutations.addActionText(store.state, "Guardando cambios...");

		return Axios({
			url: route("datos.save"),
			method: "post",
			data: fields,
		})
		.then(function(response) {
			if (response.data === true) {
				// Todo bien
				store.mutations.enableToast(store.state, {
					text: "Cambios guardados correctamente",
				});

				// Callback
				cb();
			} else {
				// Hay algo mal
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.finally(function() {
			// Ocultamos el action loader
			store.mutations.toggleAction(store.state);
		})
		.catch((error) => {
			console.error(error);
			// Hay algo mal
			store.mutations.enableToast(store.state, {
				text: "Ocurrió un problema al intentar guardar los cambios",
				type: "error",
			});
		});
	},
	getDetalles: function(data) {
		// Obtiene los campos guardados en un nodo
		return Axios(route("datos.get") + methods.toURL({ id_nd: data.id })).catch(
			(error) => {
				console.error(error);
			}
		);
	},
	getDatosExcepcion: function(excepciones) {
		// Obtiene los campos guardados en una excepcion
		return Axios(
			route("excepcion.datos") + methods.toURL({ id_ed: excepciones.id })
		).catch((error) => {
			console.error(error);
		});
	},
	saveRespuestas: function(fields, cb) {
		store.mutations.toggleAction(store.state);
		store.mutations.addActionText(store.state, "Guardando cambios...");

		return Axios.post(route("respuestas.save"), fields)
		.then(function(response) {
			setTimeout(() => {
				store.mutations.toggleAction(store.state);

				if (response.data) {
					// Todo bien
					store.mutations.enableToast(store.state, {
						text: "Cambios guardados correctamente",
					});
				} else {
					// Ocurrió un error
					store.mutations.enableToast(store.state, {
						text: "Ocurrió un problema al intentar guardar los cambios",
						type: "error",
					});
				}
			}, 500);
		})
		.catch(function(error) {
			console.error(error);
		})
		.finally(function() {
			cb();
		});
	},
	digitalizar: function(fields) {
		return Axios({
			url: route("digitalizar"),
			method: "post",
			data: fields,
		}).catch((error) => {
			console.error(error);
		});
	},
	getDatos: function(fields) {
		return Axios({
			url: route("datos_almacen.get", fields),
		}).catch((error) => {
			console.error(error);
		});
	},
	crearExcepcion: function(fields) {
		return Axios({
			url: route("excepciones.create"),
			method: "post",
			data: fields,
		}).catch((error) => {
			console.error(error);
		});
	},
	notificacionNotaria: function(info_nodo) {
		return Axios({
			url: route("nodo.notificacion.entrega"),
			method: "post",
			data: info_nodo,
		})
		.then(function(response) {
			var response = response.data;
			console.log(response);
			if (response) {
				// Esta todo bien
				if (!response.existe) {

					

					store.mutations.enableToast(store.state, {
						text: response,
						type: "success",
					});
				}
			} else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar enviar la notificacion",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
	terminarComision: function(info_nodo, cb) {
		return Axios({
			url: route("guardar-comision"),
			method: "post",
			data: info_nodo,
		})
		.then(function(response) {
			var response = response.data;
			console.info(response);
			if (response) {
				if (response == "La comision ya existe") {
					store.mutations.enableToast(store.state, {
						text: "La comision ya existe",
						type: "success",
					});
				} else {
					// Esta todo bien, redireccionamos
					console.info("Comision OK");
					cb();
				}
			} else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
	cambiarEstadoPregunta: function(info_nodo) {
		return Axios({
			url: route("cambiar-estado-pregunta"),
			method: "post",
			data: info_nodo,
		})
		.then(function(response) {
			var response = response.data;
			console.info(response);
			if (response) {
				if (response.respondido == "El estado ya es sí") {
					store.mutations.enableToast(store.state, {
						text: "El estado ya es sí",
						type: "success",
					});
				} else {
					// Esta todo bien, redireccionamos
					store.mutations.enableToast(store.state, {
						text: "Estado cambiado correctamente a Sí.",
						type: "success",
					});
				}
			}
			else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
	notificacion580: function(info_nodo) {
		return Axios({
			url: route("notificacion-580-581"),
			method: "post",
			data: info_nodo,
		})
		.then(function(response) {
			var response = response.data;
			console.info(response);
			if (response) {
				store.mutations.enableToast(store.state, {
					text: "Notificacion enviada",
					type: "success",
				});
			}
			else {
				// Ucurrió un problema al terminar
				console.error("Ocurrió un problema");
				store.mutations.enableToast(store.state, {
					text: "Ocurrió un problema al intentar guardar los cambios",
					type: "error",
				});
			}
		})
		.catch((error) => {
			console.error(error);
		});
	},
};
