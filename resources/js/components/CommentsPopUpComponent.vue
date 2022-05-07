<template>
<div>
<i id="show-modal" style="margin-left: 0.5rem;" @click="showCommentModal = true" title="Palikti komentarą" class="btn btn-info fa fa-thumbs-up"></i>
  <div v-if="showCommentModal">
    <transition name="modal">
        <div class="modal-mask">
          <div class="modal-wrapper">
            <div class="modal-container">

              <div class="modal-header">
                <slot name="header">
                  Palikti komentarą
                </slot>
              </div>

              <div class="modal-body">
                <h6>Komentaras</h6>
                <input v-model="comment" @change="onCommentChange($event)" type="text" name="comment" />
              </div>
              <div class="modal-body">
                 <form class="rating">
                  <label>
                    <input @change="onRatingChange($event)" type="radio" name="stars" value="1" />
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input  @change="onRatingChange($event)" type="radio" name="stars" value="2" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input  @change="onRatingChange($event)" type="radio" name="stars" value="3" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>   
                  </label>
                  <label>
                    <input @change="onRatingChange($event)" type="radio" name="stars" value="4" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                  <label>
                    <input @change="onRatingChange($event)" type="radio" name="stars" value="5" />
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                    <span class="icon">★</span>
                  </label>
                </form>
              </div>
              <div class="moda-body">
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
          onRatingChange(event){
            this.rating = event.target.value;
          },
          submitComment(event){
            if(this.comment === ""){
              this.text = "Neįvestas komentaras";
            }else{
              try{
                 axios
                .post('http://127.0.0.1:8000/volunteer/review',{
                    user_id:this.id,
                    rating:this.rating,
                    organization_id: this.organization,
                    comment: this.comment,
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
              rating: 1,
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

.rating {
  display: inline-block;
  position: relative;
  height: 50px;
  line-height: 50px;
  font-size: 50px;
}

.rating label {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  cursor: pointer;
}

.rating label:last-child {
  position: static;
}

.rating label:nth-child(1) {
  z-index: 5;
}

.rating label:nth-child(2) {
  z-index: 4;
}

.rating label:nth-child(3) {
  z-index: 3;
}

.rating label:nth-child(4) {
  z-index: 2;
}

.rating label:nth-child(5) {
  z-index: 1;
}

.rating label input {
  position: absolute;
  top: 0;
  left: 0;
  opacity: 0;
}

.rating label .icon {
  float: left;
  color: transparent;
}

.rating label:last-child .icon {
  color: #000;
}

.rating:not(:hover) label input:checked ~ .icon,
.rating:hover label:hover input ~ .icon {
  color: #09f;
}

.rating label input:focus:not(:checked) ~ .icon:last-child {
  color: #000;
  text-shadow: 0 0 5px #09f;
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