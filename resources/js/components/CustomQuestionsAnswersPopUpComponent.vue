<template>
<div>
<i id="show-modal" style="margin-top: 1rem" @click="showAnswers" title="Anketos atsakymai" class="btn btn-info fa fa-list"></i>
  <div v-if="showModal">
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  Anketos atsakymai
                </slot>
              </div>

              <div class="modal-body">
                  {{info}}
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  <button class="modal-default-button" @click="showModal = false">
                    Uždaryti
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
        id:String,
      },
      methods: {
          showAnswers(event){
              console.log(this.info);
              axios
                .get('http://127.0.0.1:8000/organization/dashboard/' +this.id + '/answers')
                .then(response => {
                    let text = "";
                    response.data.forEach(element => {
                        text = text + "+" + element + "\n";
                    });
                    this.info = text;
                    this.showModal = true;
                }
                )
          },

      },
      data() {
          return{
              showModal: false,
              info: "Anketoje Nebuvo Atsakytų klausimų",
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