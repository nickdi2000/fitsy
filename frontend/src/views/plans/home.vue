<template>
  <div>
    <b-card class="center">

      <router-link class="btn btn-success" :to="'/plans/create'">
				<feather-icon
					icon="PlusCircleIcon"
					size="16"
					class="align-text-top"
				/>
				New Plan
      </router-link>
        <help-button :msg="help" :label="'Help'"/>
    </b-card>

    <router-view />




  </div>
</template>

<script>
import { BCard, BCardText, BLink, BAlert } from 'bootstrap-vue'

export default {
  components: {
    BCard,
		BAlert,
  },
  data() {
    return {
      help: 'A Plan is the top-level item containing everything that will be available to the client such as exercises, days, tips, etc.  You must have at least one plan to go live.',
    }
  },
  

}
</script>

<style>
  .right{
    text-align:right;

  }
</style>
