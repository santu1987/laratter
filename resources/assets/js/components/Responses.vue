<template>
	<div class="row">
		<a href="#" v-on:click="load" class="btn btn-outline-primary">Ver respuestas</a>
		<div class="bg-light mt-2" v-for="response in responses">
			<div class="card">
				<div class="card-block">
					{{ response.message }}
				</div>
				<div class="card-footer text-muted">
					{{ response.created_at }}
					by
					{{ response.user.username}}
				</div>
			</div>	
		</div>
	</div>
</template>

<script>
export default{
	//Creo mis propiedades, que solo puedens er modificadas desde fuera
	props: ['message'],
	data(){
		return{
			responses:[],
		}
	},
	methods:{
		//Metodo load, ajax que envia a un controlador...
		load(){
			axios.get('/api/messages/'+ this.message +'/responses')
				 .then(res =>{
				 	this.responses = res.data;
				 });	
		}
	}
}
</script>