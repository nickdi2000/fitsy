<template>
	<div class="d-flex justify-content-center mb-1" v-if="loading">
      <b-spinner label="Loading..." type="grow" variant="primary"/>
  </div>

	<div v-else>
			<div>
				  <b-card >
						<h2>{{plan.name}}</h2>
						<div class="d-flex justify-content-center" v-if="loading">
							<b-spinner
					      class="mr-1"
					      variant="info"
					    />
						</div>

		  <b-form @submit.prevent>
		    <b-row>
		      <b-col cols="12">
		        <b-form-group
		          label="Plan name"
		          label-for="h-first-name"
		          label-cols-md="4"
		        >
		          <b-form-input
		            id="plan_name"
								v-model="plan.name"
		            placeholder="The Shred Challenge"
		          />
		        </b-form-group>
		      </b-col>

					  <b-col cols="12">
			        <b-form-group
			          label="Plan Description"
			          label-for="h-first-name"
			          label-cols-md="4"
			        >
			          <b-form-textarea
						      id="textarea-default"
						      placeholder="(optional)"
						      rows="3"
									v-model="plan.description"
						    />
			        </b-form-group>
			      </b-col>

		      <b-col cols="12">
		        <b-form-group
		          label="Publicly Available"
		          label-for="live"
		          label-cols-md="4"
		        >
		          <b-form-checkbox
					      checked="true"
					      name="live"
					      switch
					      inline
								v-model="plan.live"
					    >
		      Activate <help-button :msg="help"/>
		    </b-form-checkbox>
		        </b-form-group>
		      </b-col>

		      </b-col>

		      <!-- submit and reset -->
		      <b-container>
						<b-row align-h="start">
					    <b-col cols="8">
											<b-button
											 v-ripple.400="'rgba(255, 255, 255, 0.15)'"
											 type="submit"
											 variant="primary"
											 class="mr-1"
											 @click="save()"
										 >
											 Save
										 </b-button>
										 <router-link
											 :to="'/plans'"
											 v-ripple.400="'rgba(186, 191, 199, 0.15)'"
											 type="reset"
											 variant="outline-secondary"
										 >
											 Cancel
										 </router-link>
							</b-col>
					    <b-col cols="4" >
								<b-row align-h="end">
									<b-button variant="flat-danger" align-h="end" @click="destroy()">Delete</b-button>
								</b-row>
							</b-col>
					  </b-row>




		      </b-container>
		    </b-row>

		  </b-form>

			<b-row  v-if="plan.managePath" align-h="end">
					<router-link :to="plan.managePath" class="btn btn-flat-secondary btn-sm">Manage Plan <feather-icon icon="LogOutIcon" /></router-link>
			</b-row>


		</b-card>
		</div>
</div>
</template>

<script>
import {
  BRow, BCard, BCol, BFormGroup,
	BFormTextarea, BFormInput, BFormCheckbox, BForm, BButton, BSpinner
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'

export default {
	  data() {
	    return {
				plan: {},
				loading: false,
				help: 'Activate your plan to make it available to the public.  You may want to leave it inactive while you are editing or modifying it in some way.'
			}
	  },
  components: {
    BRow,
    BCol,
    BFormGroup,
    BFormInput,
    BFormCheckbox,
		BFormTextarea,
    BForm,
    BButton,
		BCard,
		BSpinner,
  },
  directives: {
    Ripple,
  },
	methods: {
		save(){
			let route = "/api/plans/";
			let planData = this.plan;
					axios
						.post(route, planData)
						.then(response => {
							console.log(response);
							this.showToast(response.message);
							this.$router.push('/plans/');
						})
						.catch(error => {
							console.log(error);
						});

		},
		getData(){
			let route = "/api/plans/" + this.$route.params.id;
			axios.get(route)
				.then(res => {
					this.plan = res.data;
					this.loading = false;
				});
		},
		destroy(){
			this.$swal({
					title: 'Delete Record?',
					showCloseButton: true,
					showCancelButton: true,
					icon: 'error',

			}).then(val =>{
				if(val.isConfirmed){
					axios.delete("/api/plans/" + this.$route.params.id)
						.then(res=> {
								this.showToast(res.message);
								this.$router.push('/plans/');
						});
				}
			});
		},

	},
	mounted(){
			console.log('param: ' + this.$route.params.id);
			//this.loading = true;
			this.getData();


	}
}
</script>
