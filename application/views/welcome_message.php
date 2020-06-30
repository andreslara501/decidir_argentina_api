<!DOCTYPE html>
<html>
<head>
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>

<div id="app">
	<v-app>
		<v-content>
			<v-container>
				<v-row

					justify="space-between"
				>
					<v-col
						cols="12"
						md="6"
					>
						<h1>Pago con tarjeta débito {{paid}}</h1>

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
							<p>Ingresa tu tarjeta de crédito</p>
							<v-form ref="form">
								<v-text-field
									v-model="card_holder_name"
									label="Nombre del propietario de la tarjeta de crédito"
								>
								</v-text-field>

								<v-text-field
									v-model="card_holder_id"
									label="identification"
								>
								</v-text-field>

								<v-text-field
									v-model="card_number"
									:counter="16"
									label="Tarjeta de crédito"
								>
								</v-text-field>

								<v-row
									justify="space-between"
								>
									<v-col class="d-flex" cols="6" sm="6">
										<v-select
											v-model="card_expiration_month"
											:items="months"
											label="Mes"
											solo
										>
										</v-select>
									</v-col>

									<v-col class="d-flex" cols="6" sm="6">
										<v-select
											v-model="card_expiration_year"
											item-text="year"
											item-value="value"
											:items="years"
											label="Año"
											solo
										>
										</v-select>
									</v-col>
								</v-row>

								<v-text-field
									v-if="card_type!=2"
									v-model="security_code"
									:counter="3"
									label="Código de seguridad (CVV)"
								>
								</v-text-field>

								<v-switch
								  v-model="save_data"
								  label="Guardar información para futuras transacciones"
								></v-switch>

								<v-btn 
									color="success" 
									@click="sendForm"
									dark
								>
									Realizar pago
								</v-btn>
							</div>
						</v-form>
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
			card_type: null,
			card_holder_name: 'John Doe',
			card_holder_id: '1061705320',
			card_number: '4517721004856075',
			card_expiration_month: '03',
			card_expiration_year: '25',
			security_code: '123',
			card_holder_identification_type: 'dni',
			card_holder_identification_number: '25123456x',
			save_data: true,

			cards_type: [
				{
					'type': 'Crédito',
					'value': 1
				},
				{
					'type': 'Débito',
					'value': 2
				}
			],

			months: ['01','02','03','04','05','06','07','08','09','10','11','12'],
			years: [],

			paid: false,
			loading: false,
			error: false,

			result_pay: ''
		},

		methods: {
			sendForm: function(){
				this.loading = true;
				this.error 	= false;

				let bodyFormData = new FormData();

				/* Data for Decidir api */
				bodyFormData.set('card_type', this.card_type);
				bodyFormData.set('card_holder_name', this.card_holder_name);
				bodyFormData.set('card_holder_id', this.card_holder_id);
				bodyFormData.set('card_number', this.card_number);
				bodyFormData.set('card_expiration_month', this.card_expiration_month);
				bodyFormData.set('card_expiration_year', this.card_expiration_year);
				bodyFormData.set('security_code', this.security_code);
				bodyFormData.set('card_holder_identification_type', this.card_holder_identification_type);
				bodyFormData.set('card_holder_identification_number', this.card_holder_identification_number);

				/* Save token for future transactions*/
				bodyFormData.set('save_data', this.save_data);

				axios({
					method: 'post',
					url: '/index.php/api_pay/first_pay/',
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
					// handle success
					this.loading = false;
					this.result_pay = response.data;

					alert(this.result_pay["id"]);
					
					if(this.result_pay["status"] == "approved"){
						this.paid = true;
					}else{
						this.paid 	= false;
						this.error 	= true;
					}
				})
				.catch(function (error) {
					this.loading = false;
					this.paid = 2;
					console.log(error);
				})
				.then(function(){
					// always executed
				});
			},
		},

		created: function(){
			/* Create array years */
			for(i = new Date().getFullYear(); i < new Date().getFullYear() + 10; i ++){
				this.years.push({
					'year': 	i,
					'value': 	i - 2000
				});
			}
		},


		el: '#app',
		vuetify: new Vuetify(),
	});

	Vue.config.productionTip = false;
</script>
</body>
</html>