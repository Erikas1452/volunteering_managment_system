<template>
<div>
  <button id="show-modal" @click="showModal = true">Stabdyti paskyrą</button>
  <button id="show-modal" @click="stopSuspension">Atšaukti</button>
  <div v-if="showModal">
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  Stabdyti paskyrą
                </slot>
              </div>

              <div class="modal-body">
                <h6>Stabdymo priezastis</h6>
                <input v-model="reason" @change="onReasonChange($event)" type="text" name="reason" />
                <hr>
                <h6> Stabdymo Laikotarpis </h6>
                <input v-model="date" @change="onDateChange($event)" type="date" />
              </div>
              <p style="color: red">{{text}}</p>
              <div class="modal-footer">
                <slot name="footer">
                  <button class="modal-default-button" @click="submit">
                    Stabdyti
                  </button>
                  <button class="modal-default-button" @click="showModal = false">
                    Atšaukti
                  </button>
                </slot>
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
      },
      methods: {
          onReasonChange(event){
            this.reason = event.target.value;
          },
          onDateChange(event){
            this.date = event.target.value
          },
          stopSuspension(event){
            axios
                .post('http://127.0.0.1:8000/admin/dashboard/volunteers/suspend/stop', {
                  user: this.user,
                })
                .then(response => {
                  this.info = response;
                  location.reload();
                })
          },
          submit(event){
            if(this.reason === ""){
              this.text = "Neįvesta priežastis";
            }else if(this.date === ""){
              this.text = "Nepasirinkta data";
            }else{
              axios
                .post('http://127.0.0.1:8000/admin/dashboard/volunteers/suspend', {
                  date: this.date,
                  reason: this.reason,
                  user: this.user,
                })
                .then(response => {
                  this.info = response;
                  location.reload();
                  // console.log(response.data);
                })
          }
        },

      },
      data() {
          return{
              showModal: false,
              text: "",
              reason: "",
              date:"",
              csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
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
  width: 300px;
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