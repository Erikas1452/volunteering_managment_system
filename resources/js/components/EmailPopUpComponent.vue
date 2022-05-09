<template>
<div>
    <a id="show-modal" style="color: white; background-color: #86b03c; margin-right: 0.5rem;" @click="showModal = true" title="Susisiekti" class="btn btn-success"><i class="fa fa-envelope"></i></a>
    <div v-if="showModal">
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  Siųsti žinutę
                </slot>
              </div>

              <div style="text-align-last: center;" class="modal-body">
            
                <h4>Žinutės turinys:</h4>
                <textarea style="width: 90%; max-height: 180px;" v-model="message" @change="onMessage($event)" type="text" name="message" />
                 <p style="color: red">{{text}}</p>
                 <div class="modal-body">
                     <button @click="submit" style="width: 45%;
    margin-right: 1rem;" class="btn btn-success">Siųsti</button>
                     <button @click="showModal = false;" style="width: 45%;
    margin-left: 1rem;" class="btn btn-danger">Atšaukti</button>
                 </div>
              </div>

            </div>
          </div>
        </div>
      </transition>
    </div>
  </div>
</template>

<script>
  export default {
      props:{
        user:String,
        organization:String,
        activity:String
      },
      methods: {
          onMessage(event){
            this.message = event.target.value;
          },
          submit(event){
            if(this.message === ""){
              this.text = "Neįvesta žinutė";
            }else{
              try{
                 axios
                .post('http://127.0.0.1:8000/volunteer/activity/email/send',{
                    user: this.user,
                    organization: this.organization,
                    activity: this.activity,
                    message: this.message,
                })
                .then(response => {
                    console.log(response.data);
                    this.showModal = false;
                }) 
              } catch (error) {
                  console.error(error.response.data);
              }
            }
          },

      },
      data() {
          return{
              showModal: false,
              message: "",
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
              text: "",
          }
      }
  }
</script>

<style>
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 680px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter-from {
  opacity: 0;
}

.modal-leave-to {
  opacity: 0;
}

.modal-enter-from .modal-container,
.modal-leave-to .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>