<template>
  <div>
    <h2>Days</h2>

		      <div class="text-center">
		        <button class="btn btn-primary" @click="showModal('days')">
		          <feather-icon
		  					icon="PlusCircleIcon"
		  					size="16"
		  					class="align-text-top"
		  				/>
		          Add Day</button>

		        </div>
						<hr/>
		<div>
      <p class="text-warning" v-if="!days.length">No Days Created Yet</p>

		  <app-collapse
        v-else
		    accordion
		    type="shadow"
		  ><!-- tupes could be default, margin, border-->
		      <template v-for="day in days">
		        <app-collapse-item :title="day.name" >
		          <div>
		            <i>{{day.description}}</i>
		          </div>

		          <div>
		              <day-exercise-list :day_id="day.id" />
		          </div>

		          <br/>
		          <hr>
		          <div>
		            <b-button
		                variant="outline-primary"
		                size="sm"
		                @click="showModal('exercises')"
		              >
		                <feather-icon
		                  icon="PlusIcon"
		                  class="mr-50"
		                />
		                <span class="align-middle">Create New Exercise</span>
		              </b-button>

		              <router-link
		                  class="btn btn-flat-secondary btn-sm"
		                  :to="day.editPath">Edit Day
		                </router-link>


		              <b-button
		                  variant="flat-danger"
		                  size="sm"
		                  @click="confirmDelete(day.id)">Delete Day
		                </b-button>

		          </div>
		        </app-collapse-item>
		      </template>
		  </app-collapse>
		</div>

		<div class="text-right">
			<br/>
			<help-button :msg="help" :label="'Whats a Day?'"/>
		</div>
</div>
</template>

<script>
import AppCollapse from '@core/components/app-collapse/AppCollapse.vue'
import AppCollapseItem from '@core/components/app-collapse/AppCollapseItem.vue'
import { BFormGroup} from 'bootstrap-vue'
import DayExerciseList from '@/components/DayExerciseList.vue';

export default {
  components: {
    AppCollapse,
    AppCollapseItem,
    DayExerciseList,
  },
	props: ['plan'],
  data: () => ({
    obj: {},
    help: "A 'day' refers to a day within the selected Plan.  You can add as may days as you wish.  The days can be custom named such as 'Day 1: Legs and Arms', 'Day 2' and so on, or if the plan you are creating follows a weekly schedule, you can name them after the day of the week, 'Monday', 'Tuesday', etc.",
		days: [],
  }),
  methods: {
    confirmDelete(id){
      this.$bvModal
      .msgBoxConfirm('Delete this day permanently?', {
        cancelVariant: 'outline-secondary',
      })
      .then(confirm => {
				if(confirm){
        axios.delete('/api/days/' + id)
					.then(res => {
						this.showToast(res.data.message);
						this.getData();
					});
				}

      });
    },
		getData(){
			axios.get('/api/days/by-plan/' + this.plan.id)
				.then(res => {
						this.days = res.data;
				});
		}

  },
	mounted(){
		this.getData();
	}
}
</script>
