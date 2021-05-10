// We haven't added icon's computed property because it makes this mixin coupled with UI
export const showToast = {
  data() {
    return {
      //passwordFieldType: 'password',
    }
  },
	methods:{
			showToast(msg = 'Success', type = 'success'){
				        this.$toast({
			            component: 'ToastificationContent',
			            props: {
			              title: msg,
			              icon: 'EditIcon',
			              variant: type,
			            },
			          });
							}
	},
}

export const _ = null
