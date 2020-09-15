<template>
	<div class="admin">
	 <header>
		<button class="btn btn-info btn-block" @click="add(),lastid()">add</button>
	 </header>	
		<div class="container">
			<h1 class="title-line">บทความที่คุณเขียน</h1>
		<div class="rowPageResponsive">
	 		<span style="padding-right: 10px;">แสดง</span>
				<select v-model="pageSize" @change="changeSelect()" class="pageSize">
					<option value="5">5</option>
			     	<option value="10">10</option>
			    	<option value="20">20</option>
			    </select>
		   	<span style="padding-left: 10px;">บทความ</span>
		</div>
		<div class="row navbar">
		<ul class="nav nav-tabs col-sm-10 li-item" id="myTab" role="tablist" v-if="tabSearch">
		  <li class="nav-item li-public">
		  	<a class="nav-link lineActive" data-toggle="tab" href="#public" role="tab" aria-controls="public" aria-selected="true" v-on:click="tabPublic()">
		  		<span  v-bind:class="{'line' : linePublic}" >เผยแพร่แล้ว <span class="value" v-bind:class="{'valueActive' : valuePublic}">( {{count1}} )</span></span> 
			</a>
		  </li>
		  <li class="nav-item li-save">
		    <a class="nav-link lineActive" data-toggle="tab" href="#save" role="tab" aria-controls="save" aria-selected="false" v-on:click="tabSave()">
		   		<span v-bind:class="{'line' : lineSave}">บันทึกแล้ว <span class="value" v-bind:class="{'valueActive' : valueSave}">( {{count}} )</span></span>
		   	</a>
		  </li>
		  <li class="nav-item li-delete">
		    <a class="nav-link lineActive" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false" v-on:click="tabDelete()">
		   		<span v-bind:class="{'line' : lineDelete}"> ลบ <span class="value" v-bind:class="{'valueActive' : valueDelete}">( {{count2}} )</span></span>
		   	</a>
		  </li>
		</ul>
		<div v-else class="nav nav-tabs col-sm-2 boxserach">
			<font-awesome-icon icon="search" class="search"/><span class="break-line"></span>
			   	<input type="text" placeholder="ค้นหาบทความ" class="searchText" v-model="search" autofocus>
		</div>
	    <form class="form-inline" v-on:click="Search(), iconsearch()" v-if="iconsearchTab">
		   	<font-awesome-icon icon="search" class="iconsearch-tab" />
		</form>

		<form class="form-inline " v-on:click="Search(), iconsearch()" v-else>
		   	<font-awesome-icon icon="times" class="iconsearch-tab" />
		</form>
		<!-- *********reponsive********* -->
		<div class="dropDown navResponsive" v-if="tabSearch">
			<button class="btn btn-light" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" style="-webkit-transform: scaleX(1); color: #4a4a4a">
					<div v-if="titlenumber == 1">
						เผยแพร่แล้ว <span class="value" v-bind:class="{'valueActive' : valuePublic}">( {{count1}} )</span>
					</div>
					<div v-if="titlenumber == 2">
						บันทึกแล้ว <span class="value" v-bind:class="{'valueActive' : valueSave}">( {{count}} )</span>
					</div>
					<div v-if="titlenumber == 3">
						ลบ <span class="value" v-bind:class="{'valueActive' : valueDelete}">( {{count2}} )</span>
					</div>
			<font-awesome-icon icon="chevron-down" style="margin: 7px 0 0 5px; color: #9b9b9b" />	
			</button>
			<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="width: 100%; padding: 0px; border-radius: 0px;">
				<ul class="nav nav-tabs col-sm-10" id="myTab" role="tablist">
				  <li class="nav-item">
				  	<a class="nav-link lineActive" data-toggle="tab" href="#public" role="tab" aria-controls="public" aria-selected="true" v-on:click="tabPublic(), changetitlenumber(1)">
				  		เผยแพร่แล้ว <span class="value" v-bind:class="{'valueActive' : valuePublic}">( {{count1}} )</span>
				  	</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link lineActive" data-toggle="tab" href="#save" role="tab" aria-controls="save" aria-selected="false" v-on:click="tabSave(), changetitlenumber(2)">
				   		บันทึกแล้ว <span class="value" v-bind:class="{'valueActive' : valueSave}">( {{count}} )</span>
				   	</a>
				  </li>
				  <li class="nav-item nav-textDelete">
				    <a class="nav-link lineActive" data-toggle="tab" href="#delete" role="tab" aria-controls="delete" aria-selected="false" v-on:click="tabDelete(), changetitlenumber(3)">
				   		ลบ <span class="value" v-bind:class="{'valueActive' : valueDelete}">( {{count2}} )</span>
				   	</a>
				  </li>
				</ul>
			</div>
		</div>
			<!-- *****************search tab******************* -->
		<div v-else class="nav nav-tabs col-sm-2 boxserachResponsive">
			<input type="text" placeholder="ค้นหาบทความ" class="searchTextResponsive" v-model="search" autofocus>
		</div>
	    <form class="form-inlineResponsive" v-on:click="Search(), iconsearch()" v-if="iconsearchTab">
		   	<font-awesome-icon icon="search" class="iconsearch-tabResponsive" />
		</form>
		<form class="form-inlineResponsive " v-on:click="Search(), iconsearch()" v-else>
		   	<font-awesome-icon icon="times" class="iconsearch-tabResponsive" />
		</form>
		<!-- ************************ -->
		</div> <!-- end responsive -->

	<div class="tab-content clearfix" id="myTabContent">
		<div class="tab-pane fade active show" id="public">
    		<div class="tab-pane article" id="Public" role="tabpanel" v-for = "post in sharepage"> 
			  	<div class="row"> 
					<div class="col-sm-6">
					  	<h4>{{post.title}}</h4>
						<h6>
							<span>{{post.datetime}}</span>
						</h6>
					</div>
					<div class="col-sm-6">	
						<div class="dropDown dropdownResponsive">
							<font-awesome-icon 
								icon="chevron-down"
								id="dropdownMenuButton"
								data-toggle="dropdown" 
								aria-expanded="false" />
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<div class="dropdown-item" @click="changeTohtml()" data-toggle="modal" :data-target="'#'+post.id" id="btnPreview"> 
									<font-awesome-icon icon="eye" class="dropList" />
										<span >ดูตัวอย่าง</span>
								</div>
								<div class="dropdown-item" href="#" v-on:click="editor(post.id)
								">
									<font-awesome-icon icon="pencil-alt"/>
										<span >แก้ไข</span>
								</div>
								<div class="dropdown-item" v-on:click="removed(post.id)">
									<font-awesome-icon icon="trash-alt"/>
										<span >ลบ</span>
								</div>
							</div>
						</div>
						<!-- Modal -->
							<div class="modal fade" :id="post.id" tabindex="-1" role="dialog" aria-hidden="true">  
								<div class="modal-dialog modal-lg" role="document">
									<div class=" modal-content" id="modalPreviewContent">
										<div class="modal-header" id="modalPreviewHeader">
											<h5 class="modal-title" id="modalPreviewTitle">ดูตัวอย่างบทความ</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<div aria-hidden="true"><h1 style="line-height: 0.5;" id="closeModal">&times;</h1></div>
											</button> 
										</div>
												<div class="modal-body" id="modalPreviewBody">
											<div class="boxImage" id="modalPreviewBox">
												<img :src="post.cover" alt="cover">
											</div>
											<div class="contentPreview">
												<h1><span>{{post.title}}</span></h1>
												<div class="ql-editor ql-blank" id="postContent">
													<div v-html="post.content"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- ****end Modol****	 -->
					</div>
				</div>
				<!-- </div> -->
			</div>
		    <div class="pager">
		      <span @click="sharePage" :class="{'inactive' : currentshare == 1}" style="padding-right: 10px;"><font-awesome-icon icon="chevron-left" /> ก่อนหน้า </span>
			      หน้า {{currentshare}} / {{totalshare}} 
			  <span @click="nextshare" :class="{'inactive' : currentshare == totalshare}" style="padding-left: 10px;"> ถัดไป <font-awesome-icon icon="chevron-right" /> </span>
		    </div>  
		</div>
		<div class="tab-pane fade" id="save">
        	<div class="tab-pane article" id="save" role="tabpanel" v-for="post in recordpage">
			  	<div class="row">
					<div class="col-sm-6">
					  	<h4>{{post.title}}</h4>
						<h6>
							<span>{{post.datetime}}</span>
						</h6>
					</div>
					<div class="col-sm-6">	
						<div class="dropDown dropdownResponsive">
							<font-awesome-icon 
								icon="chevron-down"
								id="dropdownMenuButton"
								data-toggle="dropdown" 
								aria-expanded="false" />
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<div class="dropdown-item" data-toggle="modal" :data-target="'#'+post.id">
								 	<font-awesome-icon icon="eye" class="dropList" /> 
								  		<span>ดูตัวอย่าง</span>
								</div>
								<div class="dropdown-item" href="#" v-model='post.status' v-on:click="public(post.id) , tabPublic()" >
									<i class="fa fa-share-alt"></i>
										<span>เผยเเพร่</span>
								</div>
								<div class="dropdown-item"v-on:click="editor(post.id)">
									<font-awesome-icon icon="pencil-alt"/>
										<span>แก้ไข</span>
								</div>
								<div class="dropdown-item" v-on:click="removed(post.id)">
									<font-awesome-icon icon="trash-alt"/>
										<span>ลบ</span>
								</div>
							</div>
						</div>
						<!-- Modal -->
							<div class="modal fade" :id="post.id" tabindex="-1" role="dialog" aria-hidden="true">  
								<div class="modal-dialog modal-lg" role="document">
									<div class=" modal-content" id="modalPreviewContent">
										<div class="modal-header" id="modalPreviewHeader">
											<h5 class="modal-title" id="modalPreviewTitle">ดูตัวอย่างบทความ</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<div aria-hidden="true"><h1 style="line-height: 0.5;" id="closeModal">&times;</h1></div>
											</button> 
										</div>
												<div class="modal-body" id="modalPreviewBody">
											<div class="boxImage" id="modalPreviewBox">
												<img :src="post.cover" alt="cover">
											</div>
											<div class="contentPreview">
												<h1><span>{{post.title}}</span></h1>
												<div class="ql-editor ql-blank" id="postContent">
													<div v-html="post.content"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- ****end Modol****	 -->
					</div>
				</div>
			</div>
			<div class="pager">
		      <span @click="recordPage" :class="{'inactive' : currentrecord == 1}" style="padding-right: 10px;"><font-awesome-icon icon="chevron-left" /> ก่อนหน้า </span>
			      หน้า {{currentrecord}} / {{totalrecord}} 
			  <span @click="nextrecord" :class="{'inactive' : currentrecord == totalrecord}" style="padding-left: 10px;"> ถัดไป <font-awesome-icon icon="chevron-right" /> </span>
		    </div> 
		</div>

        <div class="tab-pane fade" id="delete">

          	<div class="tab-pane article" id="delete" role="tabpanel" v-for="post in removedpage">
			  	<div class="row">
					<div class="col-sm-6">
					  	<h4>{{post.title}}</h4>
						<h6>
							<span>{{post.datetime}}</span>
						</h6>
					</div>
					<div class="col-sm-6">	
						<div class="dropDown dropdownResponsive">
							<font-awesome-icon 
								icon="chevron-down"
								id="dropdownMenuButton"
								data-toggle="dropdown" 
								aria-expanded="false" />
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
								<div class="dropdown-item" data-toggle="modal" :data-target="'#'+post.id">
								 	<font-awesome-icon icon="eye" class="dropList" />
								 		<span>ดูตัวอย่าง</span>
								</div>
								<div class="dropdown-item"v-on:click="record(post.id)">
								 	<font-awesome-icon icon="undo-alt"/>
										<span>คืนค่า</span>
								</div>
								<div class="dropdown-item" v-on:click="deleteArticle(post.id)">
									<font-awesome-icon icon="trash-alt"/>
										<span>ลบถาวร</span>
								</div>
							</div>
						</div>
						<!-- Modal -->
							<div class="modal fade" :id="post.id" tabindex="-1" role="dialog" aria-hidden="true">  
								<div class="modal-dialog modal-lg" role="document">
									<div class=" modal-content" id="modalPreviewContent">
										<div class="modal-header" id="modalPreviewHeader">
											<h5 class="modal-title" id="modalPreviewTitle">ดูตัวอย่างบทความ</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<div aria-hidden="true"><h1 style="line-height: 0.5;" id="closeModal">&times;</h1></div>
											</button> 
										</div>
												<div class="modal-body" id="modalPreviewBody">
											<div class="boxImage" id="modalPreviewBox">
												<img :src="post.cover" alt="cover">
											</div>
											<div class="contentPreview">
												<h1><span>{{post.title}}</span></h1>
												<div class="ql-editor ql-blank" id="postContent">
													<div v-html="post.content"></div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						<!-- ****end Modol****	 -->
					</div>
				</div>
			</div>
			<div class="pager">
		      <span @click="removedPage" :class="{'inactive' : currentremoved == 1}" style="padding-right: 10px;"><font-awesome-icon icon="chevron-left" /> ก่อนหน้า </span>
			      หน้า {{currentremoved}} / {{totalremoved}} 
			  <span @click="nextremoved" :class="{'inactive' : currentremoved == totalremoved}" style="padding-left: 10px;"> ถัดไป <font-awesome-icon icon="chevron-right" /> </span>
		    </div>   
		</div>
	</div> <!-- content in navItem -->
	<div class="rowPage">
 		<span style="padding-right: 10px;">แสดง</span>
			<select v-model="pageSize" @change="changeSelect()" class="pageSize">
				<option value="5">5</option>
		     	<option value="10">10</option>
		    	<option value="20">20</option>
		    </select>
	   	<span style="padding-left: 10px;">บทความ</span>
	</div>
	</div> <!-- end container -->
</div> <!-- end id -->
</template>

<script>
import vSelect from 'vue-select'
Vue.component('v-select', vSelect)
	export default{
		data() {
			return {
				props: ['posts'],
				components: {
    				vSelect
    			},
    			titlenumber: 1,
 				text: '',
				idPublic: 0,
				idDelete:0,
				valuePublic:true,
				valueSave:false,
				valueDelete:false,
				tabSearch: true,
				iconsearchTab:true,
				linePublic:true,
				lineSave:false,
				lineDelete:false,
				search: '',
				save:[],
				share:[],
				dalete:[],	
				post : {
					id : '',
					title : '',
					datetime : '',
					status : '',
					edit : '',
					cover : ''
				},
				count:0,
				count1: 0,
				count2: 0,
				pageSize: 5,
			    currentshare: 1,
			    currentrecord: 1,
			    currentremoved: 1,
      			totalshare: 0,
     			totalrecord: 0,
     			totalremoved: 0,
      			showUpto1: 5,
      			showUpto2: 5,
      			showUpto3: 5,
      			showFromto1: 0,
			    showFromto2: 0,
			    showFromto3: 0,
      			showUpto: 5,
      			showUpto1: 5,
      			showUpto2: 5,
			} //return
		}, //data
		mounted() {
			 this.show();
		},

		computed: {    
    			sharepage() {
  			      	var list = this.searchfilterShare.slice(this.showFromto1, this.showUpto1);
			      	this.totalshare = Math.ceil(this.searchfilterShare.length / this.pageSize);
			      	return list;
			    },
			    recordpage() {
  			      	var list = this.searchfilterRecord.slice(this.showFromto2, this.showUpto2);
			      	this.totalrecord = Math.ceil(this.searchfilterRecord.length / this.pageSize);
			      	return list;
			    },
			    removedpage() {
			      	var list = this.searchfilterRemove.slice(this.showFromto3, this.showUpto3);
			    	this.totalremoved = Math.ceil(this.searchfilterRemove.length / this.pageSize);
			    	return list;
			    },
			    searchfilterShare: function() {
		        	var that = this;
		        	return that.share.filter(function(post) {
		       		return post.title.indexOf(that.search) !== -1
		     	 })
		    	},
		    	searchfilterRecord: function() {
		        	var that = this;
		        	return that.save.filter(function(post) {
		       		return post.title.indexOf(that.search) !== -1
		     	 })
		    	},
		    	searchfilterRemove: function() {
		        	var that = this;
		        	return that.dalete.filter(function(post) {
		       		return post.title.indexOf(that.search) !== -1
		     	 })
		    	}
			    
		  	}, //end computed

		methods:{
			

			show() 
					{	
							axios.get('/tests')
							.then(data => {
								for (var i = 0; i < data.data.length; i++){
								if(data.data[i].status == "share"){
									this.share.push(data.data[i])
				            		this.count1 = this.share.length
				            	}
				            	else if(data.data[i].status == "record"){
				            		this.save.push(data.data[i])
				            		this.count = this.save.length
				            	}
				            	else if(data.data[i].status == "removed"){
				            		this.dalete.push(data.data[i])
				            		this.count2 = this.dalete.length
				            	}
				            	else console.log('error')
								}	
							})
							
			  				.catch(function (error) {
			    				console.log(error);
			  				});
			  		},

				deleteArticle(id)
					{
						if (confirm('Are You Sure?')) {
							axios.delete('/test/'+id)
							.then(response => {
								console.log(response);
							})
							.then(data=> {

								alert('Article Removed');
								location.reload();
							})
							.catch(err => console.log(err));
						}
					},

				add()
					{
						axios.post('/test/',{
							title:this.post.title ,
            				keywords:this.post.keywords ,
            				description:this.post.description ,
				            content:this.post.content , 
				            datetime:this.post.datetime ,
				            articleid:this.post.articleid,
				            cover:this.cover 
						})
					},

				showdata(id)
					{
						axios.get('/tests',{
							"id":this.post.id,
							"title":this.post.title,
				            "content":this.post.content ,
				            "cover":this.cover
						})
						.then(data => {
						  this.post.id = data.data.id ;
		                  this.post.title = data.data.title ;
		                  this.test = data.data.content;
		                  this.cover = data.data.cover;
              			})
					},

				editor(id)
					{
						axios.get('/test/'+id+'/edit')
						 	.then(data => {
						 		this.$cookie.set('test', data.data.id , 1);
						 		window.location.href = '/edit';
					            this.post.title = this.post.title ;
					            this.post.keywords = this.post.keywords;
					            this.post.description = this.post.description;
					            this.post.content = this.post.content;
					            this.post.name_article = this.post.name_article;
					            this.post.datetime = this.post.datetime;
					        })
			  				.catch(function (error) {
			    				console.log(error);
			  				});
					},

				lastid(id)
					{
						axios.get('/lastid/'+id+'/edit')
						 	.then(data => {
						 		this.$cookie.set('lastid', data.data.id , 1);
					            window.location.href = '/test/create';
					        })
			  				.catch(function (error) {
			    				console.log(error);
			  				});
					},

				public(id) 
					{
				        axios.put('/update/'+id,{
				            status:'share'
				          })
				          .then(response => {
				            location.reload();
				          })
				          .catch(err => console.log(err));
				    },

		    	record(id) {
					{
				        axios.put('/update/'+id,{
				            status:'record'
				          })
				          .then(response => {
				            location.reload();
				          })
				          .catch(err => console.log(err));
				      }
				    },

		    	removed(id) 
					{
				        axios.put('/update/'+id,{
				            status:'removed'
				          })
				          .then(response => {
				            location.reload();
				          })
				          .catch(err => console.log(err));
				    },
			update() {
				this.$forceUpdate()	
			},
			deleteID(){
				this.idPublic = this.idPublic - 1
			},
			deleteAddId(){
				this.idDelete = this.idDelete + 1
			},
			deletePost(post){
				this.articles.splice(this.id, 1)
			},
			Search() {
		      this.tabSearch = !this.tabSearch
		    },
		    iconsearch(){
		    	this.iconsearchTab = !this.iconsearchTab,
		    	this.search = ""
		    },
		    tabPublic(){
		    	if(this.valuePublic = true){
		    		this.valueSave = false,
		    		this.valueDelete = false
		    	}
		    	if(this.linePublic = true){
		    		this.lineSave = false,
		    		this.lineDelete = false
		    	}
		    },
		    tabSave(){
		    	if(this.valueSave = true){
		    		this.valuePublic = false,
		    		this.valueDelete = false
		    	}
		    	if(this.lineSave = true){
		    		this.linePublic = false,
		    		this.lineDelete = false
		    	}
		    },
		    tabDelete(){
		    	if(this.valueDelete = true){
		    		this.valueSave = false,
		    		this.valuePublic = false
		    	}
		    	if(this.lineDelete = true){
		    		this.lineSave = false,
		    		this.linePublic = false
		    	}
		    },
		    changeTohtml() {
				this.test = this.post.content
			},
		    changetitlenumber (value) {
		    	this.titlenumber = value
		    	return this.titlenumber
		    },
		    changeSelect:function(){
		      this.showUpto1 = this.pageSize;
		      this.showUpto2 = this.pageSize;
		      this.showUpto3 = this.pageSize;
		      this.currentshare = 1;
		      this.currentrecord = 1;
		      this.currentremoved = 1;
		      this.showFromto1 = 0;
		      this.showFromto2 = 0;
		      this.showFromto3 = 0;
		    },
		    nextshare() {
			      if (this.currentshare != this.totalshare){
			        this.showFromto1 = (this.currentshare * this.pageSize) ;
			        this.currentshare =  this.currentshare + 1;
			        this.showUpto1 = (this.currentshare * this.pageSize);
			      }   
			},
			nextrecord() {
			      if (this.currentrecord != this.totalrecord){
			        this.showFromto2 = (this.currentrecord * this.pageSize) ;
			        this.currentrecord =  this.currentrecord + 1;
			        this.showUpto2 = (this.currentrecord * this.pageSize); 
			      }   
			},
			nextremoved() {
			      if (this.currentremoved != this.totalremoved){
			        this.showFromto3 = (this.currentremoved * this.pageSize) ;
			        this.currentremoved =  this.currentremoved + 1;
			        this.showUpto3 = (this.currentremoved * this.pageSize); 
			      }   
			},
    		sharePage() {
			      if (this.currentshare != 1){
			        this.showFromto1 = ((this.currentshare - 2) * this.pageSize) ;
			        this.currentshare =  this.currentshare - 1;
			        this.showUpto1 = (this.currentshare * this.pageSize); 
			      }   
			},
			recordPage() {
			      if (this.currentrecord != 1){
			        this.showFromto2 = ((this.currentrecord - 2) * this.pageSize) ;
			        this.currentrecord =  this.currentrecord - 1;
			        this.showUpto2 = (this.currentrecord * this.pageSize); 
			      }   
			},
			removedPage() {
			      if (this.currentremoved != 1){
			        this.showFromto3 = ((this.currentremoved - 2) * this.pageSize) ;
			        this.currentremoved =  this.currentremoved - 1;
			        this.showUpto3 = (this.currentremoved * this.pageSize); 
			      }   
			}
		}, //end method
	} //export
</script>

<style>
@import url('https://fonts.googleapis.com/css?family=Kanit');
html{
	background-color: #f8f8f8;
}
header{
	padding-top: 50px;
}
h1 {
	font-family: 'Kanit' !important;
	color: #0193D7;
	font-weight: 700 !important;
	font-size: 30px
}
h2 {
	font-family: 'Kanit' !important;
	font-size: 24px;
	color: #4a4a4a;
	display: block;
	margin-top: 20px;
	font-weight: 700 !important
}
h3 {
	font-family: 'thonburi', sans-serif;
	color: #4a4a4a;
	line-height: 1.8;
	font-size: 16px !important;
	text-indent: 6%;
	display: block;
	margin-top: 20px;
	text-justify: inter-word
}
h4 {
	font-family: 'Kanit' !important
}
h5 {
	font-family: 'Kanit' !important;
	color:#4a4a4a
}
p {
	font-family: 'thonburi', sans-serif;
	color: #4a4a4a;
	line-height: 1.8;
	font-size: 16px;
	text-indent: 6%;
	display: block;
	margin-top: 20px;
	text-justify: inter-word
}
h6{
	line-height: 1px;
	color: #9b9b9b;
}
li{
	border-right: 2px solid #9b9b9b;
	text-align: center;
	font-family: 'Kanit', sans-serif;
}
.admin{
	background-color: #f8f8f8;
}
.li-public{
	margin: 0 0 0 -14px;
}
.li-delete{
	border: none;
}
.title-line{
	font-family: 'thonburi', sans-serif;
	border-bottom: 2px solid #9b9b9b;
	padding-bottom: 20px;
	margin-top: 30px;
    margin-bottom: 70px;
	color: #4a4a4a;
}
.navbar {
    height: 90px;
    padding: 2%;
    margin: 0px;
    list-style: none;
    border: 2px solid #9b9b9b;
	border-radius: 5px 5px 0 0;
	background-color: #fff;
}
.nav-tabs{
	border: none;
	padding: 0px;
}
.nav-tabs .nav-link{
	border: none;
	color: #9b9b9b;
	padding: 0px;
}
.nav-tabs .nav-link.active, .nav-tabs .nav-item.show .nav-link{
	border: none;
	color: #9b9b9b;
}
.lineActive{
	font-size: 24px;
}
.line{
	border-bottom: 2px solid #0193d7;
	padding-bottom: 5px;
	color: #4a4a4a;
}
.lineActive:hover{
	text-decoration: none;
	color: #9b9b9b;
}
.value{
	background: transparent;
	text-align: center;
	margin: 0 auto;
	padding: 0px;
	display: inline-block;
	color: #9b9b9b;
	font-size: 20px;
}
.valueActive{
	color: #0193d7;
}
.dropDown{
	text-align: right;
	padding: 3%;
	color: #9b9b9b;
	font-size: 23px;
}
svg#dropdownMenuButton{
	cursor: pointer;
}
.dropdown-item{
	cursor: pointer;
}
.article {
	font-family: 'Kanit', sans-serif;
	border: 2px solid #9b9b9b;
	border-top: none;
	border-radius: 0 0 2px 2px;
	padding: 20px 20px 12px 20px;
	height: 100px;
	background-color: #fff;
	color: #4a4a4a;
}
.iconsearch-tab{
	font-size: 30px;
	-webkit-transform: scaleX(-1);
	cursor: pointer;
	color: #9b9b9b;
	margin: 0 0 0 -40px;
	position: absolute;
}
.search{
	-webkit-transform: scaleX(-1);
	font-size: 30px;
	color: #9b9b9b;
	margin: 0 20px 0 15px;
}
.break-line{
	border-right: 2px solid #9b9b9b;
}
.searchText{
	font-family: 'Kanit', sans-serif;
	font-size: 23px;
	border: none;
	margin: -30px 0 0 100px;
	color: #9b9b9b;
}
.searchText:focus{
 	outline: 0;
}
input.searchText::placeholder{
	color: #9b9b9b;
}
[aria-expanded="true"]{
  -webkit-transform: scaleY(-1);
}
[aria-expanded="false"]{
  -webkit-transform: scaleX(1);
}
.navResponsive{
	display: none;
	padding: 0px;
}
.boxserachResponsive{
	display: none;
}
.searchTextResponsive{
	display: none;
}
.form-inlineResponsive{
	display: none;
}
.iconsearch-tabResponsive{
	display: none;	
}
button#dropdownMenuButton{
	width: 75%; 
	text-align: left; 
	display: inline-flex;
	padding: 0px;
	font-size: 24px;
	background-color: transparent;
	border: none;
	color: #9b9b9b;
}
button{
	font-family: 'Kanit', sans-serif;
}
.inactive{
  color:#9b9b9b;
  text-decoration:none;
} 
.pager{
	font-family: 'Kanit', sans-serif;
	font-size: 1.5rem;
	float: right;
	color: #4a4a4a;
	cursor: pointer;
	margin-top: 10px;
}
.rowPageResponsive{
	display: none;
}
.rowPage{
	font-family: 'Kanit', sans-serif;
	font-size: 1.5rem; 
	margin-top: -40px;
}
.pageSize{
	font-size: 20px;
    padding-left: 10px;
    cursor: pointer;
}
#closeModal {
	font-family: 'Kanit',sans-serif
}
.container-fluid {
	width: 100%; 
	padding-right: 0px !important; 
	padding-left: 0px !important; 
	margin-right: auto; 
	margin-left: auto; 
}
.contentPreview {
	padding:10px 70px 0px 70px;
	text-align: left;
}
.modal-header {
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
	border-top-left-radius: 0rem !important;
	border-top-right-radius: 0rem !important;
	padding: 0.5rem !important
}
.modal-footer {
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
}
.modal-dialog{
	width: 135%;  
}
.month-setter {
	width: 35% !important
}
#modalpreview.modal{
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
	width: auto;
	overflow: hidden
}
#modalPreviewTitle.modal-title {
	margin-left: auto
}
#modalPreviewContent.modal-content {
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
	width: 135%;
	margin: 0px 0 0 -140px;
}
#modalPreviewBody.modal-body {
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
	max-height: calc(100vh - 150px);
	overflow-y: auto;
	overflow-x: hidden;
	padding: 0px !important 
}
#modalPreviewBox.boxImage {
	-webkit-border-radius: 0rem !important;  
	-moz-border-radius: 0rem !important;   
	border-radius: 0rem !important;
	width: auto;
	display: -webkit-box;
	height: 317.5px;
	background-color:grey;
	opacity: 0.7
}
#modalPreviewBox.boxImage img {
	display: -webkit-box;
	width: 100%;
}
@media screen 
    and (min-device-width: 0px) 
    and (max-device-width: 568px)
    and (-webkit-min-device-pixel-ratio: 2) {
       	li{
    		width: 100%;
    		border: none;
    		display: -webkit-box;
   			display: -ms-flexbox;
   			display: flex;
    	}
		.title-line {
		    font-size: 9vw;
		}
    	.navResponsive{
    		display: inline-flex;
    		width: 100%;
    	}
    	a.nav-link.lineActive.active {
		    background: #f2f2f2;
		    color: #4a4a4a;
		    width: 100%;
		    text-align: left;
		}
    	.boxserach{
			display: none;
		}
    	.search{
    		display: none;
    	}
		.break-line{
			display: none;
		}
		.searchText{
			display: none;
		}
		.form-inline{
			display: none;
		}
		.iconsearch-tab{
			display: none;
		}
    	.li-item{
    		display: none;
    	}
    	.rowPage{
			display: none;
		}
    	.dropdownResponsive{
    		margin:-45px 0 0 0;
    	}
    	.boxserachResponsive{
    		display: block;
    	}
    	.iconsearch-tabResponsive{
			display: block;	
			font-size: 30px;
			-webkit-transform: scaleX(-1);
			cursor: pointer;
			color: #9b9b9b;
			position: absolute;
			margin: -15px 0 0 -43px;
		}
		.form-inlineResponsive{
			display: block;
		}
		.searchTextResponsive{
			display: inline-flex;
			font-family: 'Kanit', sans-serif;
			font-size: 23px;
			border: none;
			color: #080808b0;
			width: 80%;
    		margin: 0 0 0 10px;
		}
		.searchTextResponsive:focus{
		 	outline: 0;
		}
		.rowPageResponsive{
			display: block;
		    font-size: 1.5rem;
		    text-align: center;
		    margin: -35px 0 15px 0;
		    font-family: 'Kanit', sans-serif;
		}
		.pager{
			text-align: center;
    		float: none;
    		font-size: 21px;
    		margin-top: 15px;
    		margin-bottom: 25px;
		}
		#modalPreviewContent.modal-content {
			width: 70%;
			margin: 45px 0 0 1px;
		}
		#uploadModalContent.modal-content {
		width: 71%;
		}
		#modalPreviewBox.boxImage {
			height: 160px;
		}
		.contentPreview {
			padding:0px;
			text-align: left;
		}
     }
    @media (min-width: 768px){
     	.navResponsive{
     		display: none;
     	}
     	.li-public{
     		width: 14em;
/*     		margin: 0 0 0 -14px;*/
     	}
     	.li-save{
     		width: 12em;
     	}
     	.li-delete{
     		width: 8em;
     	}
     	#modalPreviewContent.modal-content {
			width: 112%;
			margin: 0px 0 0 -45px;
		}
		.contentPreview {
    		padding: 10px 20px 0px 20px;
    		text-align: left;
		}
    } 
</style>