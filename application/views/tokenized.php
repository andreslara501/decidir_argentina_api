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
						<h1>Efectuar pago</h1>
						<p>Se realizará un pago por $20.000 para la tarjeta terminada en <?php echo $last_four;?></p>

						<div v-if="paid == true">
							<p>La transacción fue realizada con éxito</p>
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

						<div v-if="!loading && paid == false">
							<v-form ref="form">
								<v-text-field
									v-model="security_code"
									:counter="3"
									label="Código de seguridad (CVV)"
								>
								</v-text-field>

								<v-btn 
									color="success" 
									@click="getToken"
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
			security_code: '123',
			id_client: <?php echo $id_client;?>,
			save_data: true,

			result_pay: '',

			paid: false,
			loading: false,
			error: false,
		},

		methods: {
			getToken: function(){
				this.loading = true;
				this.error 	= false;
				
				let bodyFormData = new FormData();

				/* Data for Decidir api */
				bodyFormData.set('security_code', this.security_code);
				bodyFormData.set('id_client', this.id_client);

				axios({
					method: 'post',
					url: '/index.php/api_pay/tokenized_pay/',
					data: bodyFormData,
					headers: {'Content-Type': 'multipart/form-data' }
					/*{
						card_number: 'Fred',
						card_expiration_month: 'Flintstone',
						card_expiration_year: '',
						security_code: '',
						card_holder_name: '',
						card_holder_identification_type: '',
						card_holder_identification_number: '',
					}*/
					}
				)
				.then(response => {
					this.loading = false;
					this.result_pay = response.data;

					if(this.result_pay == "approved"){
						this.paid = true;
					}else{
						this.paid 	= false;
						this.error 	= true;
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