<template>
  <div class="hello">
    <!-- container -->

    <div class="container" id="content">
      <br><br>
      <div class="container">
        <div class="close" id="closeModal">
          <a href="/test" style="text-decoration: none;"><h1 style="color: red;">&times;</h1></a> 
        </div>
        <div class="content left">
          <h4>เขียนบทความ</h4>
        </div>
        <hr><br>
        <div class="form-group"> 
          <div class="row">
            <div class="col-md-3">
              <div class="left">
                <label for="name"><h5>ชื่อเรื่อง</h5></label> 
              </div>
            </div>
            <div class="col-md-1 offset-md-8">
              <button type="button" class="btn-white btn-md round" data-toggle="modal" data-target="#uploadModal" id="btnCover">
                <font-awesome-icon  icon="image" class="image" style=""></font-awesome-icon>
              </button>
            </div>
          </div>
          <!-- uploadModal -->
          <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModal" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content" id="uploadModalContent">
                <div class="modal-header"id="uploadModalHeader">
                  <h5 class="modal-title" id="uploadModalTitle">เพิ่มรูปภาพหน้าปก</h5>
                </div>
                <div class="modal-body" id="uploadModalBody">
                  <input type="file" name="" id="" @change="onfileSelected"><br><br>

                  <div class="boxImage" id="uploadModalBox">
                    <img :src="cover">
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal"><span class="fontButton">ตกลง</span ></button>
                  <button type="button" class="btn btn-sm btn-outline-primary" data-dismiss="modal"><span class="fontButton">ยกเลิก</span ></button>
                </div>
              </div>
            </div>
          </div>
          <!-- endModal -->
          <textarea class="form-control" id="name" v-model="post.title"></textarea>
          <span v-if="errors != undefined && errors.title != undefined" class="error">{{errors.title[0]}}</span>
        </div>
        <br>
        <div class="row">
          <div class="col-md-4">
            <div class="left">
              <h5>หมวดหมู่</h5>
              <div class="typeSelect">
                <v-select v-model="post.articleid" :options="options" :methods="con()"></v-select>  
                <span v-if="errors != undefined && errors.articleid != undefined" class="error">{{errors.articleid[0]}}</span>
              </div>
            </div>
          </div>
          <div class="col-md-8 offset-md">
            <div class="left">
              <div class="form-group">
                <div class="left">
                  <label for="Keyword"><h5>Keywords</h5></label>
                </div>
                <textarea class="form-control" id="Keyword" v-model="post.keywords"></textarea>
                <span v-if="errors != undefined && errors.keywords != undefined" class="error">{{errors.keywords[0]}}</span>
              </div>
            </div>
          </div>
        </div>
        <br>  
        <div class="form-group">
          <div class="left">
            <label for="description" aria-describedby="emailHelp" placeholder="descripted">
              <h5>คำอธิบาย</h5>
            </label>
          </div>
          <textarea class="form-control" rows="7" id="description" maxlength="140" v-model="post.description"></textarea>
          <span v-if="errors != undefined && errors.description != undefined" class="error">{{errors.description[0]}}</span>
        </div>
        <br><br>  
        <!-- test -->
        <div v-if="showHtml" id="editorVisual"> 
          <button class="btn-sm btn btn-default text-html" id="toggleToHtml" @click="testShow(),changeTohtml()">HTML</button>
          <vue-editor v-model="post.content" 
                :methods="changeTovisual()" 
                :editorToolbar="customToolbar"
                :customModules="customModulesForEditor"
                :editorOptions="editorSettings"
                useCustomImageHandler
                @imageAdded="handleImageAdded">
          </vue-editor>
          <span v-if="errors != undefined && errors.content != undefined" class="error">{{errors.content[0]}}</span>
        </div>
        <div v-else id="editorHtml">
        <div class="html-tag">HTML Tags</div>
        <button class="btn-sm btn btn-default text-visual" id="toggleToVisual" @click="testShow(),changeTohtml()">Visual</button>
        <textarea   v-model="test" 
              :methods="changeTovisual()" 
              name="" id="htmlEditor" rows="10">
        </textarea>
        </div>

        <br><br><br>

        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <div class="left">
                <label for="calendar"><h5>วันเวลาที่เผยแพร่</h5></label>
              </div>
              <datetime format="YYYY-MM-DD H:i:s"  v-model="post.datetime"></datetime>
            </div>
          </div>
          <div class="col-md-4 offset-md-4">  
            <div class="row submitbutton">
              <h1></h1>
                <div class="btn btn-sm btn-outline-primary fontButton" @click="changeTohtml()" data-toggle="modal" data-target="#modalpreview" id="btnPreview">
                  ดูตัวอย่าง
                </div>
                <h1></h1>
                <div class="btn btn-sm btn-primary fontButton" @click="updateResult()" id="btnSubmit">
                  เผยแพร่
                </div>
            </div>
          </div>
        </div>
      <div class="modal fade" id="modalpreview" tabindex="-1" role="dialog" aria-hidden="true">  
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
                <img :src="cover" alt="cover">
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
      <!--  endModal -->
    </div>
      <br>
    </div>
  </div>
</template> 
<script src="/node_modules/vue-cookie/build/vue-cookie.js'"></script>
<script>  
  import { VueEditor } from 'vue2-editor'
  import datetime from 'vuejs-datetimepicker'
  import vSelect from 'vue-select'
  import axios from 'axios'
  import { ImageDrop } from 'quill-image-drop-module'
  import ImageResize from 'quill-image-resize-module'
  Vue.component('v-select', vSelect)
  
export default {
  data () {
    return {
      // fortest
      test:'',
      // fordropdown
      options: [      
        { value: 1, label: 'รีไฟแนนซ์' },
        { value: 2, label: 'สินเชื่อบ้านแลกเงิน' },
        { value: 3, label: 'สินเชื่อบ้านใหม่' },
        { value: 4, label: 'ความรู้ด้านการเงิน' }, 
      ],
      selected: 'สินเชื่อบ้านแลกเงิน',
        // foreditor
        customToolbar: [
              [{ 'header': [2,3,false] }],
              [{ 'color': ['#0193D7','red','#4a4a4a','black'] }],
              ['bold'],
              ['italic'],
              ['underline'],
              ['strike'],
              ['blockquote'],
              ['code-block'],
              [{ 'align':''}],
              [{ 'align':'center'}],
              [{ 'align':'right'}],
              [{ 'align':'justify'}],
              [{ 'indent': '-1' }],
              [{ 'indent': '+1' }],
              [{ 'list': 'ordered' }],
              [{ 'list': 'bullet' }],
              [{ 'script': 'sub' }],
              [{ 'script': 'super' }],
              [{ 'direction': 'rtl' }],
              ['link'],
              ['image'],
              ['video'],
          ],
      customModulesForEditor: [
            { alias: 'imageDrop', module: ImageDrop },
            { alias: 'imageResize', module: ImageResize }
          ],
      editorSettings: {
            modules: {
              imageDrop: true,
              imageResize: {}
            }
          },   
      cover:'',
      image:'', 
      posts:[],
      post:[{
        id:'',
        title:'',
        content:'',
        description:'',
        datetime:'',
        articleid:'',
        edit:''
      }],
      errors: [],
      tests:'',
      post_id:'',
      edit:false,
      // for dropdown
     selectedFile:null,
     showHtml: true
    }
  },
  components: {
    VueEditor,datetime,vSelect
  },
  computed:{
     
  },
  mounted() {

      this.show();
  },
  methods:{

   
    //for data() 
    show() {

          this.post.edit = this.$cookie.get('test');

        axios.get('/test/'+this.post.edit+'/edit', {
            "id":this.post.id,
            "title":this.post.title,
            "keywords":this.post.keywords ,
            "description":this.post.description ,
            "content":this.post.content ,
            "cover":this.cover,
            "articleid":this.post.articleid ,
            "datetime":this.post.datetime 
            
          })
            .then(data => {
                  this.post.title = data.data.title ;
                  this.post.keywords = data.data.keywords;
                  this.post.description = data.data.description;
                  this.test = data.data.content;
                  this.cover = data.data.cover;
                  this.post.articleid = data.data.articleid;
                  this.post.datetime =data.data.datetime;
              })
            // .then(function (response) {
            //   console.log(response);
            // })
            .catch(function (error) {
              console.log(error)
            });


          },
    updateResult() {
      {
        axios.put('/test/'+this.post.edit,{
            title:this.post.title ,
            keywords:this.post.keywords ,
            description:this.post.description ,
            content:this.post.content ,
            cover:this.cover,
            articleid:this.post.articleid ,
            datetime:this.post.datetime 
            
          })
          .then(response => {
            console.log(response);
          })
          .then(data => {
            this.post.title = '';
            this.post.keywords = '';
            this.post.description = '';
            this.post.content = '';
            this.cover = '';
            this.post.name_article = '';
            this.post.datetime = '';
            
            
            alert('อัพเดตข้อมูลเเล้ว');
            window.location.href = '/test';
          })
          .catch(error => {
            this.errors = error.response.data.errors
          })
      }
    },

    con(){
      if(this.post.articleid == 1){
        this.post.articleid = 'รีไฟแนนซ์'
      }
      else if(this.post.articleid == 2){
        this.post.articleid = 'สินเชื่อบ้านแลกเงิน'
      }
      else if(this.post.articleid == 3){
        this.post.articleid = 'สินเชื่อบ้านใหม่'
      }
      else if(this.post.articleid == 4){
        this.post.articleid = 'ความรู้ด้านการเงิน'
      }
    },

    onfileSelected(e){
      var files = e.target.files || e.dataTransfer.files;
      this.createCov(files[0]); //file the image to our function
    },
    createCov(file) {
      var image = new Image;
      var reader = new FileReader;

      reader.onload = (e) => {
        this.cover = e.target.result;
      };
      reader.readAsDataURL(file);
    }, 
    changeTohtml() {
        this.test = this.post.content
      },
      changeTovisual() {
        this.post.content = this.test
      },
      handleImageAdded(file, Editor, cursorLocation) {
        let formData = new FormData();
        
        formData.append('image', file);

        axios.post( '/saveEdit',
            formData,
            {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          })
        .then((result) => {
          let Url = result.data
          Editor.insertEmbed(cursorLocation, 'image', Url)  //for show on Vue2-editor 
        })
        .catch(function(error) {
          console.log(error)
        })
      },
      testShow() {
        this.showHtml  = !this.showHtml
      }
  }
}
</script>
<style>
  .hello {
    font-family: 'Thonburi' !important;
    background-color: #f8f8f8
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
  hr {
    size: 10px !important;
    border-top: 2px solid rgba(0,0,0,0.1)
  }
  input {
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-border-radius: 2px !important;  
    -moz-border-radius: 2px !important;   
    border-radius: 2px !important;
    width:100%;
  }
  span.error {
      color: red;
  }
  .btn-sm {
    height: 35px;
    width: 75px;
    cursor: pointer;
    -webkit-border-radius: 4px !important;  
    -moz-border-radius: 4px !important;   
    border-radius: 4px !important;
  }
  .btn-md {
    cursor: pointer
  }
  .btn:focus, .btn.focus{
    box-shadow: none;
  }
  #btnCover {
    float: right;
    margin-top: -2px
  }
  #btnSubmit {
    margin:0 0 0 32px; 
  }
  .calender-div {
    font-family: 'Kanit' !important;
    width: 100% !important;
    text-align: center;
    top: -300px !important
  }
  #content.container {
    background-color: #f8f8f8
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
  .contentPreview h1 {
    font-family: 'Kanit' !important;
    color: #0193D7;
    font-weight: 700 !important;
    font-size: 30px
  }
  .contentPreview img {
    display: block;
      max-width: 100%;
      height: auto;
  }
  #editorVisual, #editorHtml {
    height: 450px 
  }
  .fontButton {
    font-size: 15px;
    height: 40px;
    width: 45%;
    padding-top: 7px;
  }  
  .form-control {
    -webkit-border-radius: 2px !important;  
    -moz-border-radius: 2px !important;   
    border-radius: 2px !important;
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1)
  }
  #htmlEditor {
    -webkit-border-radius: 2px !important;  
    -moz-border-radius: 2px !important;   
    border-radius: 2px !important;
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1) 
  }
  .htmlContent {
    display: block;
  }
  .htmlContent .ql-toolbar{
    display: none !important
  }
  .html-tag{
    font-family: 'Kanit' !important;
    width: 90%;
    height: 50px;
    background-color: #fff;
    border: 1px solid #ccc;
    border-bottom: 1px solid #f3f3f3;
    border-right: none;
    border-radius: 5px 0 0 0;
    display: inline-block;
    text-align: center;
    padding: 10px;
  }
  .left {
    text-align: left
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
  .port:hover,.days,.okButton {
    color: #0193D7 !important
  }
  #postContent.ql-editor {
    overflow-y: inherit;
    padding: 12px 0px
  }
  #postContent.ql-editor h1{
    color: #0193D7
  }
  #month.nav-l {
    background: none
  }
  #month.nav-r {
    background: none
  }
  .nav-l,.nav-r {
    font-size: 15px !important
  }
  div#quill-container {
    border-radius: 0 0 5px 5px;
  }
  .ql-snow {
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1)
  }
  .ql-editor{
    background-color:white !important;
    height: 400px !important;
    border-radius: 0 0 5px 5px;
  }
  .quillWrapper .ql-snow.ql-toolbar{
    padding-top: 8px;
    height: 100%;
    display: -ms-inline-flexbox;
    border-radius: 5px 0 0 0;
    background-color: white;
    border-bottom: 1px solid #f3f3f3 !important;
    width: 100%;
    padding-bottom: 0px !important;
  }
  .ql-toolbar.ql-snow button {
    opacity: 0.75;
    margin-left: -3px;
  }
  .round {
    -webkit-border-radius: 50%;  
    -moz-border-radius: 50%;   
    border-radius: 50%; 
    background:inherit
  }
  .submitbutton {
    margin: 30px 0 0 0;
  }
  textarea#name.form-control,textarea#Keyword.form-control {
    height: 40px;
    resize: none
  }
  textarea#description.form-control {
    height: 100px;
    resize:none
  }
  textarea#htmlEditor{
    width:100%;
    height: 400px;
    resize: none;
    border: 1px solid #ccc;
    border-top: none;
    border-radius: 0 0 5px 5px !important;
  }
  .text-html {
    font-family: 'Kanit' !important;
    float: right;
    width: 10%;
    height: 50px;
    background: #f8f8f8;
    border: 1px solid #C9C9C9;
    border-left: none;
    -webkit-border-radius: 0 5px 0 0 !important;  
    -moz-border-radius: 0 5px 0 0 !important;   
    border-radius: 0 5px 0 0 !important;
    margin-bottom: -1px;
  }
  .text-visual {
    font-family: 'Kanit' !important;
    float: right;
    width: 10%;
    height: 50px;
    background: #f8f8f8;;
    border: 1px solid #C9C9C9;
    -webkit-border-radius: 0 5px 0 0 !important;  
    -moz-border-radius: 0 5px 0 0 !important;   
    border-radius: 0 5px 0 0 !important;
  }
  #toggleToHtml {
    border: 1px solid #C9C9C9;
  }
  #tj-datetime-input {
    font-family: 'Kanit' !important;
  }
  .typeSelect {
    margin-top: 15px
  }
  .v-select .dropdown-toggle {
    background: white;
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-border-radius: 0rem !important;  
    -moz-border-radius: 0rem !important;   
    border-radius: 0rem !important*/
  }
  .v-select .dropdown-toggle .form-control {
    box-shadow:none !important;
    -webkit-box-shadow:none !important;
    -moz-box-shadow:none !important
  }
  .v-select input[type="search"],
  .v-select input[type="search"]:focus {
    height: 38px;
    width: 1px !important;
    box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -webkit-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1);
    -moz-box-shadow:0 3px 9px 0 rgba(0, 0, 0, 0.1)
  }  
  #uploadModalContent.modal-header {
    -webkit-border-radius: 0rem !important;  
    -moz-border-radius: 0rem !important;   
    border-radius: 0rem !important;*/
    background-color: #0193D7 !important
  }
  #uploadModalHeader.modal-header {
    background-color: #0193D7 !important
  }
  #uploadModalTitle.modal-title {
    margin-left: 0.8rem;
    color: white
  }
  #uploadModalContent.modal-content {
    -webkit-border-radius: 0rem !important;  
    -moz-border-radius: 0rem !important;   
    border-radius: 0rem !important;*/
    width: auto
  }
  #uploadModalBody.modal-body {
    -webkit-border-radius: 0rem !important;  
    -moz-border-radius: 0rem !important;   
    border-radius: 0rem !important;
    width: auto   
  }
  #uploadModalBox.boxImage {
    width: auto;
    display: -webkit-box;
    height: 160px;
    text-align: center;
    background-color:grey;
    opacity: 0.7
  }
  #uploadModalBox.boxImage img {
    display: -webkit-box;
    width: 100%
  }
  .year-month-wrapper,.activePort,li.active {
    background-color: #0193D7 !important
  }
  .year,.month {
    font-size: 15px !important;
    text-align: center!important
  }
  #year.nav-l {
    background: none;
  }
  #year.nav-r {
    background: none
  }
  @media screen 
    and (min-device-width: 320px) 
    and (max-device-width: 568px)
    and (-webkit-min-device-pixel-ratio: 2) {
      .quillWrapper .ql-snow.ql-toolbar{
        width: 100%
      }
      .ql-editor {
        height: 304px !important
      }
      .text-html {
        width: 20%;
      }
      .html-tag {
        width: 80%;
      }
      .text-visual {
        width: 20%;
      }
      .round{
        margin: -35px 0 0px 0px;
      }
      .v-select.searchable .dropdown-toggle {
        margin-bottom: 10%;
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
      #btnCover {
        margin-top: -45px
      }
      #btnSubmit {
        margin:0 0 0 24px; 
      }
      .contentPreview {
        padding:0px;
        text-align: left;
      }
      .contentPreview h1 {
        padding-left: 20px !important;
        padding-right: 20px !important
      }
      #postContent.ql-editor {
        padding-left: 20px!important;
        padding-right: 20px!important;
      }
  }
    @media only screen 
    and (min-device-width: 768px) 
    and (max-device-width: 1024px) 
    and (-webkit-min-device-pixel-ratio: 1) {
      #modalPreviewContent.modal-content {
        width: 112%;
        margin: 110px 0 0 -45px;
      }
      .contentPreview {
        padding: 10px 20px 0px 20px;
        text-align: left;
      }
      #btnSubmit {
        margin: 0 0 0 20px;
      }
      .ql-editor {
        height: 372px !important
      }
      .calender-div {
        width: 130% !important
      }
      #tj-datetime-input {
        width: 130% !important
      }
      #modalPreviewBox.boxImage {
        height: 160px;
    }
  }
</style>