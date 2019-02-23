<template>
  <div class="container">
    <div class="row">
      <div class="col-md-4"> 
        <form action="#" @submit.prevent="tweet">
         <div class="form-group">
           <textarea v-model="post" class="form-control" maxlength="140" placeholder="What are you upto" rows="5"></textarea>

         </div>
         <input type="submit" value="Post" class="form-control">
       </form>
     </div>
     <div class="col-md-8">
      <p v-if="!posts.length">No post yet. follow someone </p>
      <div class="posts">
        <div class="media" transition="expand" v-for="post in posts" track-by="id">
          <br> <br> <br>
          <div class="media-left">
            <img :src="post.user.avatar" class="media-object" alt="">           
          </div>
          <div class="media-body">
            <div class="user">
              <a :href="'user/'+post.user.id"><strong>{{post.user.username}}</strong></a>  {{post.diffForHumans}} 

            </div>
            <p>{{post.body}}</p>
          </div>
        </div>

      </div> 
    </div>
  </div>
</div>
</template>

<script>
export default {
  data(){
    return{
      post:'',
      posts:[],
      limit:20
    }
  },

  methods:{
    tweet(){
      axios.post('/post', {
        body:this.post
      })
      .then((response)=> {
        console.log(response.data)
        this.post = ''   
        this.posts.unshift(response.data);
      });
      
    },
    getposts(){
      axios.get('posts').then((response)=>{
        this.posts=response.data;
      })
    }
  },
  mounted() {
    setInterval(()=>{
     this.getposts()
   },10000)

  }
}
</script>
