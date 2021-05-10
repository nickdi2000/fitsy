<template>
  <div>
    <b-row>
      <b-col>
      <b-card title="Welcome!">
        <b-card-text>
  				Welcome to the <b>Fitsy.Me Coach Portal</b>.
          <br/>
          <hr>
          <router-link :to="'/plans'" class="btn btn-primary" icon="ListIcon">
            <feather-icon
                icon="ListIcon"
                class="mr-50"
              />
              My Plans
          </router-link>
          <button @click="getData()" class="btn">Refresh</button>
  			</b-card-text>
      </b-card>
    </b-col>
    </b-row>


    <b-row>

      <b-col
        cols="4"
      >
        <statistic-card-vertical
          color="primary"
          icon="UsersIcon"
          :statistic="stats.clients"
          statistic-title="Clients"
        />
      </b-col>

      <b-col
        cols="4"
      >
        <statistic-card-vertical
          color="info"
          icon="BookOpenIcon"
          :statistic="stats.plans"
          statistic-title="Plans"
        />
      </b-col>

    </b-row>

  </div>
</template>

<script>
import { BCard, BCardText, BLink, BCol, BRow } from 'bootstrap-vue'
import { mapGetters } from 'vuex'
import StatisticCardVertical from '@core/components/statistics-cards/StatisticCardVertical.vue'

export default {
	  data: () => ({
	    //me: {}
      stats: {clients: 0, plans: 0}, //predefining to avoid undefined, will be replaced by axios
	  }),
  components: {
    BCard,
    BCardText,
    BLink,
    BCol,
    BRow,
    StatisticCardVertical,
  },
  computed: {
    ...mapGetters({
      user: 'user',
      token: 'token',
    })
  },
  props: ['me'],
	methods:{
		checkAuth(){
			store.dispatch('checkAuth');
		},
    getData(){
      console.log("id: " + this.user.id);
      let route = '/api/pub/user/stats';
        axios.get(route)
          .then(res => {
              this.stats = res.data;
          })
    }
	},
	mounted(){
		this.getData();
	}
}
</script>

<style>

</style>
