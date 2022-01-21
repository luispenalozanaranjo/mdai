<template>
	<p class="date-now" v-if="timestamp" v-text="timestamp"></p>
</template>

<script>	
	export default{
		data: function(){
			return {
				months: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
				days: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
				timestamp: false
			};
		},
		created: function(){
			this.getNow();
			setInterval( this.getNow, 1000 );
		},
		methods: {
			addZero: function(i){
				if (i < 10) {
				  i = "0" + i;
				}
				return i;
			},
			getNow: function() {
				const today = new Date();
				const dayN = this.days[(today.getDay())];
				const day = this.addZero(today.getDate());
				const month = this.months[today.getMonth()];
				const year = today.getFullYear();

				const hour = this.addZero(today.getHours());
				const minutes = this.addZero(today.getMinutes());
				const seconds = this.addZero(today.getSeconds());

				const date = dayN + ' ' + day + ' de ' + month + ' del ' + year;
				const time = hour + ":" + minutes;
				const dateTime = `${date} - ${time}`;
				this.timestamp = dateTime;
			}
		}
	}
</script>