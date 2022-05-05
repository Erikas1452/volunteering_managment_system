<template>
<div>
<i id="show-modal" style="margin-left: 0.5rem;" @click="showCommentModal = true" title="Palikti nusiskundimą" class="btn btn-warning fa fa-thumbs-down"></i>
  <div v-if="showCommentModal">
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  Palikti nusiskundimą
                </slot>
              </div>

              <div class="modal-body">
                <h6>Nusiskundimas</h6>
                <input v-model="comment" @change="onCommentChange($event)" type="text" name="comment" />
                 <p style="color: red">{{text}}</p>
              </div>

              <div class="modal-footer">
                <slot name="footer">
                  <button class="modal-default-button" @click="submitComment">
                    Siūsti
                  </button>
                  <button class="modal-default-button" @click="showCommentModal = false">
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
        organization:String,
        id:String,
      },
      methods: {
           onCommentChange(event){
            this.comment = event.target.value;
          },
          submitComment(event){
            if(this.comment === ""){
              this.text = "Neįvestas nusiskundimas";
            }else{
              try{
                 axios
                .post('http://127.0.0.1:8000/volunteer/complaint',{
                    user_id:this.id,
                    organization_id: this.organization,
                    complaint: this.comment,
                })
                .then(response => {
                    console.log(response);
                    this.showCommentModal = false;
                }) 
              } catch (error) {
                  console.error(error.response.data);
              }
            }
          },

      },
      data() {
          return{
              showCommentModal: false,
              comment: "",
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