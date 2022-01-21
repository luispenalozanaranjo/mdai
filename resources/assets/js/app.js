// require('./bootstrap');
window.Vue = require("vue");
window.EventBus = new Vue();

// Global imports
import route from "ziggy";
import Axios from "axios";
import Vuex from "vuex";
import store from "./store";
import methods from "./methods";
import nodos from "./nodos";
import Vue from "vue";

// Configuración de Axios, token de laravel para poder realizar las peticiones
Axios.defaults.headers.common["X-CSRF-TOKEN"] = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
Axios.defaults.headers.post["Content-Type"] = "multipart/form-data";

Vue.use(Vuex);
Vue.prototype.$http = Axios;
Vue.prototype.$methods = methods;
Vue.prototype.$nodos = nodos;
Vue.config.productionTip = false;

// Vuex
const $store = new Vuex.Store(store);

// Mixins
import mobile from './mixins/mobile';
Vue.mixin(mobile);
Vue.mixin({ methods: { route: route } });

// Filters
import rut from "./filters/rut.js";
import capitalize from "./filters/capitalize.js";
Vue.filter("rut", rut);
Vue.filter("capitalize", capitalize);

// Directives
import onlynumbers from "./directives/onlynumbers.js";
Vue.directive("onlynumbers", onlynumbers);

// Componentes
import mainMenu from "./components/main-menu.vue";
Vue.component("mdai-main-menu", mainMenu);

// Componentes UI
import actionLoader from "./components-ui/action-loader.vue";
import table from "./components-ui/table.vue";
import paginador from "./components-ui/paginador.vue";
import showResults from "./components-ui/results-show.vue";
import tooltip from "./components-ui/tooltip.vue";
import lightbox from "./components-ui/lightbox.vue";
import accordion from "./components-ui/accordion.vue";
import dateNow from "./components-ui/date-now.vue";
import notifications from "./components-ui/notificaciones.vue";
import profile from "./components-ui/profile.vue";
import toast from "./components-ui/toast.vue";
import status from "./components-ui/status.vue";
import box from "./components-ui/box.vue";
import errorsShow from "./components-ui/errors-show.vue";
import btnAction from "./components-ui/btn-action.vue";
import input from "./components-ui/input.vue";
import select from "./components-ui/select.vue";
import support from "./components-ui/support.vue";

Vue.component("mdai-action-loader", actionLoader);
Vue.component("mdai-table", table);
Vue.component("mdai-paginador", paginador);
Vue.component("mdai-results-show", showResults);
Vue.component("mdai-tooltip", tooltip);
Vue.component("mdai-lightbox", lightbox);
Vue.component("mdai-accordion", accordion);
Vue.component("mdai-datenow", dateNow);
Vue.component("mdai-notifications", notifications);
Vue.component("mdai-profile", profile);
Vue.component("mdai-toast", toast);
Vue.component("mdai-status", status);
Vue.component("mdai-box", box);
Vue.component("mdai-errors-show", errorsShow);
Vue.component("mdai-btn-action", btnAction);
Vue.component("mdai-input", input);
Vue.component("mdai-select", select);
Vue.component("mdai-support", support);

// Componentes funcionales
import resumenCliente from "./components/pages/promesas/resumen-cliente.vue";
import resumenClientePreventa from "./components/pages/promesas/resumen-cliente-preventa.vue";
import resumenContacto from "./components/pages/promesas/resumen-contacto.vue";
import resumenWorkflow from "./components/pages/promesas/resumen-workflow.vue";
import resumenExcepcion from "./components/pages/promesas/resumen-excepcion.vue";
import resumenFlujo from "./components/pages/promesas/excepcion-flujo.vue";

Vue.component("mdai-resumen-cliente", resumenCliente);
Vue.component("mdai-resumen-cliente-preventa", resumenClientePreventa);
Vue.component("mdai-resumen-contacto", resumenContacto);
Vue.component("mdai-resumen-workflow", resumenWorkflow);
Vue.component("mdai-resumen-excepcion", resumenExcepcion);
Vue.component("mdai-excepcion-flujo", resumenFlujo);

// Pages
import login from "./components/pages/login/login.vue";
import cargaPlanilla from "./components/pages/planilla/carga-planilla.vue";
import cargaPreguntas from "./components/pages/formularios/carga-preguntas.vue";
import checklistsDetalles from "./components/pages/formularios/checklist-detalle.vue";
import editarChecklist from "./components/pages/formularios/checklist-editar.vue";
import agregarChecklistPregunta from "./components/pages/formularios/preguntas/pregunta-agregar.vue";
import editarChecklistPregunta from "./components/pages/formularios/preguntas/pregunta-editar.vue";
import homeClientes from "./components/pages/clientes/home-clientes.vue";
import busquedaPromesa from "./components/pages/promesas/busqueda-promesa.vue";
import bitacora from "./components/pages/promesas/bitacora.vue";

Vue.component("mdai-login", login);
Vue.component("mdai-carga-planilla", cargaPlanilla);
Vue.component("mdai-checklist-detalle", checklistsDetalles);
Vue.component("mdai-checklist-editar", editarChecklist);
Vue.component("mdai-checklist-pregunta-agregar", agregarChecklistPregunta);
Vue.component("mdai-checklist-pregunta-editar", editarChecklistPregunta);
Vue.component("mdai-carga-preguntas", cargaPreguntas);
Vue.component("mdai-clientes-home", homeClientes);
Vue.component("mdai-busqueda-promesa", busquedaPromesa);
Vue.component("mdai-bitacora", bitacora);

// Reutilizables
import checklist from "./components/pages/promesas/checklist.vue";
import checklistComision from "./components/pages/comisiones/checklist-comision.vue";
import busquedaComision from "./components/pages/comisiones/busqueda-comision.vue";
import buscadorReversa from "./components/pages/reversa/buscador-reversa.vue";
import reversa from "./components/pages/reversa/reversa.vue";
import digitalizar from "./components/pages/promesas/digitalizar.vue";
import subirDocumentos from "./components/pages/promesas/subir-documentos.vue";

Vue.component("mdai-checklist", checklist);
Vue.component("mdai-comision", checklistComision);
Vue.component("mdai-busqueda-comision", busquedaComision);
Vue.component("mdai-busqueda-reversa", buscadorReversa);
Vue.component("mdai-reversa", reversa);
Vue.component("mdai-digitalizar", digitalizar);
Vue.component("mdai-subir-documentos", subirDocumentos);

// Excepciones
import autorizacionCheck from "./components/pages/promesas/excepciones/autorizacion-check.vue";
import envioOficinaCentral from "./components/pages/promesas/excepciones/envio-oficina-central.vue";
import recepcionDocumentacion from "./components/pages/promesas/excepciones/recepcion-documentacion.vue";
import solicitudDocCliente from "./components/pages/promesas/excepciones/solicitud-doc-cliente.vue";

Vue.component("mdai-autorizacion-check-excep", autorizacionCheck);
Vue.component("mdai-envio-of-central-excep", envioOficinaCentral);
Vue.component("mdai-recepcion-of-central-excep", recepcionDocumentacion);
Vue.component("mdai-solicitud-doc-cli-excep", solicitudDocCliente);

// Desistimiento
import solicitudCliente from "./components/pages/promesas/desistimiento/solicitud-cliente.vue";
import contactarCliente from "./components/pages/promesas/desistimiento/contactar-cliente.vue";
import firmaCliente from "./components/pages/promesas/desistimiento/firma-cliente.vue";
import revisionCarpeta from "./components/pages/promesas/desistimiento/revision-carpeta.vue";
import entregaDocumentacion from "./components/pages/promesas/desistimiento/entrega-documentacion.vue";
import devolucionDocumentos from "./components/pages/promesas/desistimiento/devolucion-documentos.vue";
import aprobacionDesistimiento from "./components/pages/promesas/desistimiento/aprobacion-desistimiento.vue";
import envioCopiaOficinaCentral from "./components/pages/promesas/desistimiento/envio-copia-oficina-central.vue";
import recepcionDocumentacionDes from "./components/pages/promesas/desistimiento/recepcion-documentacion.vue";
import firmaGerenciaDigitalizarNotificar from "./components/pages/promesas/desistimiento/firma-gerencia-digitalizar-notificar.vue";
import notificacionRenunciaDevolucion from "./components/pages/promesas/desistimiento/notificacion-renuncia-devolucion.vue";

Vue.component("mdai-de-solicitud-cliente", solicitudCliente);
Vue.component("mdai-de-contactar-cliente", contactarCliente);
Vue.component("mdai-de-firma-cliente", firmaCliente);
Vue.component("mdai-de-revision-carpeta", revisionCarpeta);
Vue.component("mdai-de-entrega-documentacion", entregaDocumentacion);
Vue.component("mdai-de-devolucion-documentos", devolucionDocumentos);
Vue.component("mdai-de-aprobacion-desistimiento", aprobacionDesistimiento);
Vue.component("mdai-de-envio-copia-oficina-central", envioCopiaOficinaCentral);
Vue.component("mdai-de-recepcion-documentacion", recepcionDocumentacionDes);
Vue.component("mdai-de-firma-gerencia-digitalizar-notificar", firmaGerenciaDigitalizarNotificar);
Vue.component("mdai-de-notificacion-renuncia-devolucion", notificacionRenunciaDevolucion);

// Etapa 1
import envioOfCentral from "./components/pages/promesas/etapa-1/envio-of-central.vue";
import recepcionOfCentral from "./components/pages/promesas/etapa-1/recepcion-of-central.vue";
import asignacionRevisor from "./components/pages/promesas/etapa-1/asignacion-revisor.vue";
import visado from "./components/pages/promesas/etapa-1/visado.vue";
import firmaGerencia from "./components/pages/promesas/etapa-1/firma-gerencia.vue";
import oficinaVentaEnvio from "./components/pages/promesas/etapa-1/oficina-venta-envio.vue";
import oficinaVentaRecepcion from "./components/pages/promesas/etapa-1/oficina-venta-recepcion.vue";
import revisionAbogado from "./components/pages/promesas/etapa-1/revision-abogado.vue";
import revisionNotaria from "./components/pages/promesas/etapa-1/revision-notaria.vue";
import envioCorreoCliente from "./components/pages/promesas/etapa-1/envio-correo-cliente.vue";

Vue.component("mdai-envio-of-central", envioOfCentral);
Vue.component("mdai-recepcion-of-central", recepcionOfCentral);
Vue.component("mdai-asignacion-revisor", asignacionRevisor);
Vue.component("mdai-visado", visado);
Vue.component("mdai-firma-gerencia", firmaGerencia);
Vue.component("mdai-oficina-venta-envio", oficinaVentaEnvio);
Vue.component("mdai-oficina-venta-recepcion", oficinaVentaRecepcion);
Vue.component("mdai-revision-abogado", revisionAbogado);
Vue.component("mdai-revision-notaria", revisionNotaria);
Vue.component("mdai-envio-correo-cliente", envioCorreoCliente);

// Etapa 2
import tipoCredito from "./components/pages/promesas/etapa-2/tipo-credito.vue";
import solicitudInfoBanco from "./components/pages/promesas/etapa-2/solicitud-info-banco.vue";
import revisionRiesgo from "./components/pages/promesas/etapa-2/revision-riesgo.vue";

Vue.component("mdai-tipo-credito", tipoCredito);
Vue.component("mdai-solicitud-info-banco", solicitudInfoBanco);
Vue.component("mdai-revision-riesgo", revisionRiesgo);

// Etapa 4
import ordenEscritura from "./components/pages/promesas/etapa-4/orden-escrituracion.vue";
import ordenEscrituracionBanco from "./components/pages/promesas/etapa-4/orden-escrituracion-banco.vue";
import borradorEscritura from "./components/pages/promesas/etapa-4/borrador-escritura.vue";
import notificacionNotaria from "./components/pages/promesas/etapa-4/notificacion-notaria.vue";
import comprobacionFirma from "./components/pages/promesas/etapa-4/comprobacion-firma.vue";
import cierreCopias from "./components/pages/promesas/etapa-4/cierre-copias.vue";
import ingresoCbr from "./components/pages/promesas/etapa-4/ingreso-cbr.vue";
import egresoCbr from "./components/pages/promesas/etapa-4/egreso-cbr.vue";
import egresoCbrChip from "./components/pages/promesas/etapa-4/egreso-cbr-chip.vue";
import estadoEscrituracion from "./components/pages/promesas/etapa-4/estado-escrituracion.vue";

Vue.component("mdai-orden-escrituracion", ordenEscritura);
Vue.component("mdai-orden-escrituracion-banco", ordenEscrituracionBanco);
Vue.component("mdai-borrador-escritura", borradorEscritura);
Vue.component("mdai-notificacion-notaria", notificacionNotaria);
Vue.component("mdai-comprobacion-firma", comprobacionFirma);
Vue.component("mdai-cierre-copias", cierreCopias);
Vue.component("mdai-ingreso-cbr", ingresoCbr);
Vue.component("mdai-egreso-cbr", egresoCbr);
Vue.component("mdai-egreso-cbr-chip", egresoCbrChip);
Vue.component("mdai-estado-escrituracion", estadoEscrituracion);

// Finanzas
import liquidacionGastosOperacionales from "./components/pages/pagos/liquidacion-gastos-operacionales.vue";
import pagoOperacion from "./components/pages/pagos/pago-operacion.vue";
import busquedaPromesaLiquidacion from "./components/pages/pagos/busqueda-promesa-liquidacion.vue";
import busquedaPromesaPago from "./components/pages/pagos/busqueda-promesa-pago.vue";

Vue.component("mdai-liquidacion-gastos-op", liquidacionGastosOperacionales);
Vue.component("mdai-pago-operacion", pagoOperacion);
Vue.component("mdai-busqueda-promesa-liquidacion", busquedaPromesaLiquidacion);
Vue.component("mdai-busqueda-promesa-pago", busquedaPromesaPago);

// Cambio de unidad
import cuSolicitud from "./components/pages/promesas/cambio-unidad/cu-solicitud.vue";
import cuAprobacionComercial from "./components/pages/promesas/cambio-unidad/cu-aprobacion-comercial.vue";
import cuAnalisisRiesgo from "./components/pages/promesas/cambio-unidad/cu-analisis-riesgo.vue";
import cuRechazoCambioUnidad from "./components/pages/promesas/cambio-unidad/cu-rechazo-cambio-unidad.vue";
import cuAnalisisRiesgo2 from "./components/pages/promesas/cambio-unidad/cu-analisis-riesgo-2.vue";
import cuGenerarModificacion from "./components/pages/promesas/cambio-unidad/cu-generar-modificacion.vue";
import cuFirmaCliente from "./components/pages/promesas/cambio-unidad/cu-firma-cliente.vue";
import cuModificacionUnidadSistema from "./components/pages/promesas/cambio-unidad/cu-modificacion-unidad-sistema.vue";
import cuEnvioCopiaOfCentral from "./components/pages/promesas/cambio-unidad/cu-envio-copia-of-central.vue";
import cuRecepcionCopiaOfCentral from "./components/pages/promesas/cambio-unidad/cu-recepcion-copia-of-central.vue";
import cuFirmaGerencial from "./components/pages/promesas/cambio-unidad/cu-firma-gerencial.vue";
import cuModificaStock from "./components/pages/promesas/cambio-unidad/cu-modifica-stock.vue";
import cuEnvioDocSdv from "./components/pages/promesas/cambio-unidad/cu-envio-doc-sdv.vue";
import cuEntregaDocCliente from "./components/pages/promesas/cambio-unidad/cu-entrega-doc-cliente.vue";

Vue.component("mdai-cu-solicitud", cuSolicitud);
Vue.component("mdai-cu-aprobacion-comercial", cuAprobacionComercial);
Vue.component("mdai-cu-analisis-riesgo", cuAnalisisRiesgo);
Vue.component("mdai-cu-rechazo-cambio-unidad", cuRechazoCambioUnidad);
Vue.component("mdai-cu-analisis-riesgo-2", cuAnalisisRiesgo2);
Vue.component("mdai-cu-generar-modificacion", cuGenerarModificacion);
Vue.component("mdai-cu-firma-cliente", cuFirmaCliente);
Vue.component("mdai-cu-modificacion-unidad-sis", cuModificacionUnidadSistema);
Vue.component("mdai-cu-envio-copia-of-central", cuEnvioCopiaOfCentral);
Vue.component("mdai-cu-recepcion-copia-of-central", cuRecepcionCopiaOfCentral);
Vue.component("mdai-cu-firma-gerencial", cuFirmaGerencial);
Vue.component("mdai-cu-modifica-stock", cuModificaStock);
Vue.component("mdai-cu-envio-doc-sdv", cuEnvioDocSdv);
Vue.component("mdai-cu-entrega-doc-cliente", cuEntregaDocCliente);

// Usuarios
import usuarios from "./components/pages/usuarios/usuarios.vue";
import usuarioAgregar from "./components/pages/usuarios/usuario-agregar.vue";
import usuarioDetalle from "./components/pages/usuarios/usuario-detalle.vue";

Vue.component("mdai-usuarios", usuarios);
Vue.component("mdai-usuarios-agregar", usuarioAgregar);
Vue.component("mdai-usuario-detalle", usuarioDetalle);

// Entidades financieras
import entidadesAgregar from "./components/pages/entidades-financieras/entidades-agregar.vue";
import entidadesDetalle from "./components/pages/entidades-financieras/entidades-detalle.vue";

Vue.component("mdai-entidades-agregar", entidadesAgregar);
Vue.component("mdai-entidades-detalle", entidadesDetalle);

// Etapas
import etapas from "./components/pages/etapa/etapa.vue";
Vue.component("mdai-etapas", etapas);

// Proyectos
import proyectoEdit from "./components/pages/proyectos/edit.vue";
import etapaEdit from "./components/pages/proyectos/etapa-edit.vue";
Vue.component("mdai-proyectos-edit", proyectoEdit);
Vue.component("mdai-proyectos-etapa-edit", etapaEdit);

// Escrituracion
import esBusquedaEntregaUnidad from "./components/pages/escrituracion/busqueda-entrega-unidad.vue";
import esEntregaUnidad from "./components/pages/escrituracion/entrega-unidad.vue";

Vue.component("mdai-busqueda-entrega-unidad", esBusquedaEntregaUnidad);
Vue.component("mdai-entrega-unidad", esEntregaUnidad);

// Pre-Reserva
import checklistprereserva from "./components/pages/promesas/checklistprereserva.vue";
import busquedaPrereserva from "./components/pages/promesas/busqueda-prereserva.vue";

Vue.component("mdai-check-list-prereserva", checklistprereserva);
Vue.component("mdai-busqueda-prereserva", busquedaPrereserva);

const app = new Vue({
	el: "#app",
	store: $store
});

function fadeOut(target){
	let fadeTarget = document.querySelector(target);
	let fadeEffect = setInterval(function() {
		if (!fadeTarget.style.opacity) {
			fadeTarget.style.opacity = 1;
		}
		if (fadeTarget.style.opacity > 0) {
			fadeTarget.style.opacity -= 0.1;
		}
		else {
			clearInterval(fadeEffect);
			fadeTarget.classList.remove("active");
		}
	}, 10);
}

window.addEventListener("load", function() {
	setTimeout(() => {
		fadeOut("#app-loader");
	}, 300);
});