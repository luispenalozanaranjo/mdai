<template>
    <div class="content-block mt-32">
        <div class="content-block">
            <mdai-accordion title="Resumen Nodo" :active="true">
                <div class="form">
                    <div class="row total mini align-items-end">
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Etapa</label>
                                <p class="fw-semibold">{{ checklist.etapa }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Número Nodo</label>
                                <p class="fw-semibold">{{ checklist.num_nodo }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Actividad</label>
                                <p class="fw-semibold">{{ nodo.actividad }}</p>
                            </div>
                        </div>
                        <div class="col-6 col-sm">
                            <div class="input-cont">
                                <label class="label">Subactividad</label>
                                <p class="fw-semibold">{{ nodo.subactividad }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </mdai-accordion>
        </div>

        <div class="content-block mt-32">
            <div class="row total mini align-items-center">
                <div class="col-12 col-sm-6">
                    <h3 class="heading-4">Preguntas</h3>
                    <p>{{ $methods.showTotal(checklist.preguntas.length, 'pregunta', 'preguntas') }}</p>
                </div>
                <div class="col-12 col-sm-6 text-right">
                    <a :href="route('checklists.preguntas.agregar', checklist.id)" class="btn btn-action btn-secondary">Agregar pregunta</a>
                </div>
            </div>

            <mdai-table class="mt-16" :head="['Nº', 'Pregunta', 'Configuración campo', 'Tipo campo', 'Requerido', 'Visible', 'Acciones']" :body="checklist.preguntas">
                <template slot-scope="{item}">
                    <td width="50" v-text="item.num_pregunta"></td>
                    <td width="50%" v-text="item.encabezado_pregunta"></td>
                    <td v-text="item.configuracion ? item.configuracion : '-'"></td>
                    <td v-text="item.tipo ? item.tipo : 'check'"></td>
                    <td>
                        <span v-if="item.requerido" class="fa fa-check"></span>
                        <span v-else class="fa fa-times"></span>
                    </td>
                    <td>
                        <span v-if="item.deleted_at" class="fa fa-times"></span>
                        <span v-else class="fa fa-check"></span>
                    </td>
                    <td>
                        <div class="row-actions">
                            <a :href="route('checklists.preguntas.editar', item.id)">
                                <mdai-tooltip text="Editar pregunta" position="top">
                                    <span class="fa fa-edit"></span>
                                </mdai-tooltip>
                            </a>
                            <a href="#" @click.prevent="disablePrompt(item)" v-if="!item.deleted_at">
                                <mdai-tooltip text="Deshabilitar pregunta" position="top">
                                    <span class="fa fa-eye-slash"></span>
                                </mdai-tooltip>
                            </a>
                            <a href="#" @click.prevent="showPrompt(item)" v-if="item.deleted_at">
                                <mdai-tooltip text="Habilitar pregunta" position="top">
                                    <span class="fa fa-eye"></span>
                                </mdai-tooltip>
                            </a>
                        </div>
                    </td>
                </template>
            </mdai-table>
        </div>

        <mdai-lightbox v-model="modalDisable" title="Deshabilitar pregunta">
            <mdai-support class="mb-16" v-if="hideResponse" :theme="hideResponse.status ? 'success' : 'error'">
                <p>{{ hideResponse.message }}</p>
            </mdai-support>

			<p>
                ¿Está seguro que desea deshabilitar la siguiente pregunta?:
                <mark class="d-block mt-4" v-if="preguntaSelected">{{ preguntaSelected.num_pregunta }} - {{ preguntaSelected.encabezado_pregunta }}</mark>
            </p>

			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-12 col-sm-6">
						<a href="#" class="text-link" @click.prevent="modalDisable = false">Cancelar</a>
					</div>
					<div class="col-12 col-sm-6 text-right">
						<mdai-btn-action class="btn-primary btn-action" text="Deshabilitar pregunta" v-model="disabling" @action="disable" />
					</div>
				</div>
			</div>
		</mdai-lightbox>

        <mdai-lightbox v-model="modalShow" title="Habilitar pregunta">
            <mdai-support class="mb-16" v-if="showResponse" :theme="showResponse.status ? 'success' : 'error'">
                <p>{{ showResponse.message }}</p>
            </mdai-support>

			<p>
                ¿Está seguro que desea habilitar la siguiente pregunta?:
                <mark class="d-block mt-4" v-if="preguntaSelected">{{ preguntaSelected.num_pregunta }} - {{ preguntaSelected.encabezado_pregunta }}</mark>
            </p>

			<div class="btn-holder">
				<div class="row total align-items-center">
					<div class="col-12 col-sm-6">
						<a href="#" class="text-link" @click.prevent="modalShow = false">Cancelar</a>
					</div>
					<div class="col-12 col-sm-6 text-right">
						<mdai-btn-action class="btn-primary btn-action" text="Habilitar pregunta" v-model="enabiling" @action="enable" />
					</div>
				</div>
			</div>
		</mdai-lightbox>
    </div>
</template>

<script>
    export default{
        props: {
            checklist: {type: Object, required: true},
            nodo: {type: Object, required: true}
        },
        data: function(){
            return {
                modalDisable: false,
                modalShow: false,
                preguntaSelected: null,
                hideResponse: false,
                showResponse: false,
                disabling: false,
                enabiling: false
            };
        },
        methods: {
            disablePrompt: function(item){
                // Levantamos la modal para deshabilitar la pregunta
                this.preguntaSelected = item;
                this.modalDisable = true;
            },
            showPrompt: function(item){
                // Levantamos la modal para dhabilitar la pregunta
                this.preguntaSelected = item;
                this.modalShow = true;
            },
            disable: function(){
                this.disabling = true;

                this.$http({
                    method: 'delete',
                    url: route('checklists.preguntas.delete', this.preguntaSelected.id),
                    data: this.preguntaSelected
                })
                .then(response => {
                    this.hideResponse = response.data;

                    if( response.data.status ){
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                    else{
                        this.disabling = false;
                    }
                });
            },
            enable: function(){
                this.enabiling = true;

                this.$http({
                    method: 'put',
                    url: route('checklists.preguntas.enable', this.preguntaSelected.id),
                    data: this.preguntaSelected
                })
                .then(response => {
                    this.showResponse = response.data;

                    if( response.data.status ){
                        setTimeout(() => {
                            window.location.reload();
                        }, 1000);
                    }
                    else{
                        this.enabiling = false;
                    }
                });
            }
        }
    }
</script>