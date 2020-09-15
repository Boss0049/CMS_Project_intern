<template>
  <div class="blog">
  	<div class="container">
   <div class="head">{{ msg }}</div>
      <button type="button" class="btn btn-primary modal-post" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo" v-on:click="modal()">Post</button>
    <div class="head-line"></div>
       <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" v-bind:class="{'is-active' : isActive}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" v-on:click="clearData()">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form>
                  <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" id="recipient-name" v-model="newPost.title" placeholder="Title">
                  </div>
                  <div class="form-group">
                    <label for="message-text" class="col-form-label">Body:</label><br><br><br><br><br><br>
                    <vue-editor class="form-body" v-model="newPost.body" placeholder="Your Story"></vue-editor>

                   </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" v-on:click="clearData()">Close</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal"  v-on:click="modal() ,addPost() ,clearData()" >Add</button>
              </div>
            </div>
          </div>
      </div>

      <div class="row">
        <div class="col-sm-4" v-for="post in posts">
          <div class="thumbnail">
          <div class="content">
              <h3>{{post.title}}</h3>
              <p><div v-html="post.body"></div></p>
          </div>
        </div>
         </div>
      </div>

    <!-- ***************test************* -->
        
          
        
          

    <!-- ***************end-test************* -->


   </div>
  </div> 
</template>

<script>
import { VueEditor } from 'vue2-editor'
export default {
  name: 'blog',
  components: {
      VueEditor
   },
  data () {
    return {
     	posts:[
    		{
          'title' : 'Where does it come from?',
    		  'body'  : 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry s standard dummy text ever since the 1500s, when an unknown printer took a'
        }
    	],
    	newPost:{
    		'title': "",
    		'body' : ""
    	},    	
    	msg : 'Welcome',
      text : 'Hi',
     	isActive : false
     }
  },
  methods:{
  	modal(){
  		this.isActive = !this.isActive
  	},
  	addPost:function(){
  		if(this.newPost.title != '' && this.newPost.body){
  		this.posts.push({
  			'title' : this.newPost.title,
  			'body'  : this.newPost.body
  		}),
  		this.newPost = {}
  	 	}
    },
    clearData(){
      this.newPost.title = '',
      this.newPost.body = ''
    }
  } 


}
</script>

<style scoped>
.head{
	font-size: 35px;
  text-align: center;
  margin-top: 20px;
}
.head-line{
	border-bottom: 2px solid #ccc;
}
.modal-post{
  float: right;
  margin-top: -45px;
}
.content{
  border : 1px solid #ccc;
  text-align: center;
  margin: 10px 0 10px 0;
}
.form-body{
  margin-top: -120px;
}
</style>