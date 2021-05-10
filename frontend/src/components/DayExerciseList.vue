<!-- list the exercises for a given day, prop of day_id provided -->

<template>
  <div>
		<template v-for="ex in exercises">
     <b-button variant="gradient-primary" block>
       {{ex.name}}
    </b-button>
	</template>
  </div>
</template>

<script>
import { BCard, BCardText, BLink, BAlert } from 'bootstrap-vue'

export default {
  name: 'day-exercise-list',
  components: {
    BCard,
    BAlert
  },
  props: ['day_id'],
  data() {
    return {
      exercises: [],
    }
  },
	methods: {
		getData(){
			axios.get('/api/exercises/get-by-day/' + this.day_id)
			.then(res => {
				console.log(res);
				this.exercises = res.data;
			});
		}
	},
	mounted(){
		this.getData();
	}
}
</script>
