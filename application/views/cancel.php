<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
    <?php  
      $vars = get_defined_vars();  
      //print_r($vars);  
    ?>  
<div id="app">
	<v-app>
		<v-content>
			<v-container>
				<v-row

					justify="space-between"
				>
					<v-col
						cols="12"
						md="4"
					>
						<h1>Cancelar pago</h1>
						<p>Id del pago</p>

						<div v-if="state_result == 'approved'">
							<p>Cancelado con éxito</p>
						</div>


						<div v-if="state_result == 'annulled'">
							<p>Error, ya anulado</p>
						</div>

					    <v-alert 
					    	v-if="error == true"
					    	type="error"
					    >
					    	No se pudo realizar el pago, los datos están incorrectos
					    </v-alert>

						<div v-if="loading">
							<v-text-field color="primary" loading disabled></v-text-field>
							<p>Procesando pago...</p>
						</div>

						<div v-if="!loading && !state_result">
							<v-form ref="form">
								<v-text-field
									v-model="id_transaction"
									:counter="10"
									label="Id del pago"
								>
								</v-text-field>

								<v-btn 
									color="success" 
									@click="cancelPay"
									dark
								>
									Realizar pago
								</v-btn>

							</v-form>
						</div>
					</v-col>
				</v-row>
			</v-container>
		</v-content>
	</v-app>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>

<script>
	new Vue({
		data: {
			id_transaction: <?php echo $id_transaction;?>,
			state_result: false,
			loading: false,
			error: false,
		},

		methods: {
			cancelPay: function(){
				this.loading = true;
				this.error 	= false;

				let bodyFormData = new FormData();

				/* Data for Decidir api */
				bodyFormData.set('id_transaction', this.id_transaction);

				axios({
					method: 'post',
					url: '/index.php/api_pay/cancel/',
					data: bodyFormData,
					headers: {'Content-Type': 'multipart/form-data' }
					}
				)
				.then(response => {
					this.loading = false;
					if(typeof response.data["validation_errors"] !== 'undefined'){
						this.state_result = response.data["validation_errors"].status;
					}else{
						this.state_result = response.data.status;
					}
				})
				.catch(function (error) {
					// handle error
					console.log(error);
				})
				.then(function () {
					// always executed
				});
			},
		},

		created: function(){
		},

		el: '#app',
		vuetify: new Vuetify(),
	});

	Vue.config.productionTip = false;
</script>
</body>
</html>