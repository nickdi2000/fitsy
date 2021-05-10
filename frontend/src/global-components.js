import Vue from 'vue'
import FeatherIcon from '@core/components/feather-icon/FeatherIcon.vue';
import ToastificationContent from '@core/components/toastification/ToastificationContent.vue';
import VueSweetalert2 from 'vue-sweetalert2'
import BCard from 'bootstrap-vue'

//custom components nickdi
import HelpButton from '@core/components/custom/HelpButton.vue';
Vue.component('help-button', HelpButton);

Vue.component(FeatherIcon.name, FeatherIcon);
Vue.component('ToastificationContent', ToastificationContent);
Vue.use(VueSweetalert2)
Vue.use(BCard)
