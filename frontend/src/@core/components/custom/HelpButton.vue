<template>
  <span>

      <b-button
        v-b-toggle.collapse-2
        variant="flat-light"
      > <small>{{label}}</small>
          <feather-icon
            icon="HelpCircleIcon"
          />
      </b-button>


        <b-collapse id="collapse-2" >
								<b-card>
									<div class="alert alert-warning text-left">
                  	{{msg}}
									</div>
                </b-card>
        </b-collapse>

      <!--
      <div>
        <b-alert :show="show" dismissible variant="light">
          <div class="alert-body">
            {{msg}}
          </div>
        </b-alert>
      </div>
    -->



  </span>
</template>

<script>
import { BButton, BAlert} from 'bootstrap-vue'
import Ripple from 'vue-ripple-directive'
import 'animate.css'

export default {
  components: {
    BButton,
		BAlert,
  },
  props: ['msg', 'label'],
  data: () => ({
    show: false,
  }),
  name: 'HelpButton',
  directives: {
    Ripple,
  },
  methods: {
    showModal() {
      this.$swal({
        title: 'Tip',
        text: this.msg,
        customClass: {
          confirmButton: 'btn btn-primary',
        },
        showClass: {
          popup: 'animate__animated animate__fadeIn',
        },
        buttonsStyling: false,
      })
    },
    showAlert(){
      this.show = true;
    }
  }
}
</script>
