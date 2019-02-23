<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4"> 
        <form action="#" @submit.prevent="tweet">
         <div class="form-group">
           <textarea v-model="post" class="form-control" maxlength="140" placeholder="What are you upto" rows="5"></textarea>
           {{post}}
         </div>
         <input type="submit" value="Post" class="form-control">
       </form>
     </div>
     <div class="col-md-8">
       Timeline   
     </div>
   </div>
 </div>
</template>

<script>
export default {
  data(){
    return{
      post:'',
    }
  },

  methods:{
    tweet(){
      axios.post('/post', {
        body:this.post
      })
      .then(function (response) {
        this.post = ' ' ;
        console.log(this.post);
      })
      .catch(function (error) {
        console.log(error);
      });
    }
  },
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
