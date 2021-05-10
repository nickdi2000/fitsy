<template>
  <div>
    <b-alert variant="warning" :show="!plans.length" >
      <div class="alert-body">
        <feather-icon
          icon="InfoIcon"
          class="mr-50"
        />No plans created yet.  Create a plan!
      </div>
    </b-alert>

    <template v-for="p in plans" >
      <b-card border-variant="primary" class="shadow">
          <h3>{{p.name}}</h3>
          <p>{{p.description}}</p>

        <div>
          <router-link class="btn btn-primary" :to="p.managePath">Manage</router-link>
          <router-link class="btn btn-secondary" :to="p.editPath">Edit Details</router-link>
        </div>

      </b-card>
  </template>


  </div>
</template>

<script>
import { BCard, BCardText, BLink, BAlert } from 'bootstrap-vue'

export default {
  components: {
    BCard,
    BAlert
  },
  data() {
    return {
      plans: [],
    }
  },
  methods: {
    getData(){
      let route = "/api/plans/";
      axios
        .get(route)
        .then(res =>{
          console.log(res.data);
          this.plans = res.data;
        });
    }
  },
  mounted(){
    this.getData();
  }
}
</script>
