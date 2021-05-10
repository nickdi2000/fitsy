<template>
	<div>
		  <b-card >
				<h2>{{day.name}}</h2>
				<div class="d-flex justify-content-center" v-if="loading">
					<b-spinner
			      class="mr-1"
			      variant="info"
			    />
				</div>

  <b-form @submit.prevent v-else>
    <b-row>
      <b-col cols="12">
        <b-form-group
          label="Day Name"
          label-for="h-first-name"
          label-cols-md="4"
        >
          <b-form-input
            id="day_name"
						v-model="day.name"
            placeholder="Tuesday.."
          />
        </b-form-group>
      </b-col>

			  <b-col cols="12">
	        <b-form-group
	          label="Day Note"
	          label-for="h-first-name"
	          label-cols-md="4"
	        >
	          <b-form-textarea
				      id="textarea-default"
				      placeholder="(optional) Today we will focus on..."
				      rows="3"
							v-model="day.description"
				    />
	        </b-form-group>
	      </b-col>

      <b-col cols="12">
        <b-form-group
          label="Active"
          label-for="live"
          label-cols-md="4"
        >
          <b-form-checkbox
			      checked="true"
			      name="live"
			      switch
			      inline
						v-model="day.active"
			    >
      Activate <help-button :msg="help"/>
    </b-form-checkbox>
        </b-form-group>
      </b-col>

      </b-col>

      <!-- submit and reset -->
      <b-col offset-md="4">
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
					:to="plan.details.managePath"
          v-ripple.400="'rgba(186, 191, 199, 0.15)'"
          type="reset"
          variant="outline-secondary"
        >
          Cancel
        </router-link>
      </b-col>
    </b-row>

  </b-form>
</b-card>
</div>

</template>

<script>
import {
  BRow, BCard, BCol, BFormGroup,
	BFormTextarea, BFormInput, BFormCheckbox, BForm, BButton, BSpinner
} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import { showToast } from '@core/mixins/showToast'

export default {
	  data() {
	    return {
				day: {},
				loading: false,
				help: 'Feel free to keep your day inactive while its being created or modified.'
			}
	  },
	mixins: [showToast],
	props: ['plan'],
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
			let route = "/api/days/";
			let dayData = this.day;
					axios
						.post(route, dayData)
						.then(response => {
							console.log(response);
							this.showToast(response.message);
							this.$router.push('/days/');
						})
						.catch(error => {
							console.log(error);
						});

		},
		getData(){
			let route = "/api/days/" + this.$route.params.id;
			axios.get(route)
				.then(res => {
					this.day = res.data;
					console.log(res.data);
					this.loading = false;
				});
		}
	},
	mounted(){
			this.loading = true;
			this.getData();

	}
}
</script>
