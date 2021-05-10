
export const showModal = {

  methods: {
    showModal(model) {
      const pk = this.$route.params.id; //get id from url slug
      let short = desc[model] ? desc[model] : 'record';

      this.$swal({
        title: 'Create ' + short,
        text: 'Enter a name for the ' + short,
        showCloseButton: true,
        input: 'text',
        customClass: {
          confirmButton: 'btn btn-primary',
        },
        showClass: {
          popup: 'animate__animated animate__fadeIn',
        },
        buttonsStyling: false,
      }).then(res =>{
          let data = {name:res.value, key: pk};
          if (res.value){
            axios
             .post('/api/' + model, data)
             .then(res => {
                this.showToast('Record Created Successfully');
								this.getData();
             });
           }
      });
    }

  }


}

//readable label for model
const desc = {
  "days" : 'Day',
  "exercises" : 'Exercise',
};

export const _ = null
