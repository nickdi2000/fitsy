<template>
  <div>
    <b-card>
      <b-alert show variant="primary" v-if="plan">
        <div class="alert-body">
        <h3>{{plan.name}}</h3>
        <p>{{plan.description}}</p>
      </div>
      </b-alert>

    </b-card>

  <b-card>
      <router-view :plan="plan" />
  </b-card>



  </div>
</template>

<script>
import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from '@core/components/app-collapse/AppCollapseItem.vue'
import { BFormGroup, BAlert} from 'bootstrap-vue'


export default {
  components: {
    AppCollapse,
    AppCollapseItem,
    BAlert,
    //AppCollapseItemMargin,
  },
  data: () => ({
    model: 'days',
    days: {},
    help: `A 'day' refers to a day within the selected Plan.  You can add as may days as you wish.
          The days can be custom named such as 'Day 1: Legs and Arms', 'Day 2' and so on, or if the
          plan you are creating follows a weekly schedule, you can name them after the day of the week,
          'Monday', 'Tuesday', etc.`,
    plan: {},
  }),
  methods: {
    //get meta plan data for working section and child router-view
    getData(){
      //console.log('planner: ' + this.$route.params.id);
        axios.get('/api/plans/' + this.$route.params.id)
          .then(res => {
            this.plan = res.data;
          });
    },

  },
  mounted(){
    this.getData();
  }
}
</script>
