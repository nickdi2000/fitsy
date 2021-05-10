<template>
  <div>
    <b-card>
      <b-alert show variant="primary" >
        <div class="alert-body">
        <h3>Exercise Library</h3>
        <p class="text-secondary"><strong>NOTE:</strong> This is a master list of all your exercises.
          Keep in mind that, while you are free to create an exercise in this section (and later attach it to one or many plans -> days),
          <strong>you will also be given the opportunity to create exercises during the flow of creating a plan.</strong>  These exercises will also display here, and will be available to attach to other plans.
          </p>
      </div>
      </b-alert>

    </b-card>

    <b-card>
      <b-table
           v-if="exercises"
           small
           :fields="headers"
           :items="exercises"
          >
          <template #cell(Edit)="data">
            <router-link class="btn btn-outline-info btn-sm" :to="'plans'">Edit</router-link>
          </template>

         </b-table>
    </b-card>





  </div>
</template>

<script>
import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from '@core/components/app-collapse/AppCollapseItem.vue'
import { BFormGroup, BAlert, BTable} from 'bootstrap-vue'


export default {
  components: {
    AppCollapse,
    AppCollapseItem,
    BAlert,
    //AppCollapseItemMargin,
  },
  data: () => ({
    model: 'exercises',
    exercises: [],
    help: `Exercise Help`,
    headers: ['name', 'Edit'],
  }),
  methods: {
    getData(){
        axios.get('/api/exercises/list')
          .then(res => {
            this.exercises = res.data;
          });
    },

  },
  mounted(){
    this.getData();
  }
}
</script>
