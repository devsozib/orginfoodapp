<template>
    <div>
        <form @submit.prevent="upload" enctype="multipart/form-data">
            <input type="file" v-on:change="fileName"/>
            <button>Upload</button>
        </form>

        <ul style="margin-top:100px">
            <li style="padding:10px" v-for="(image,index) in images" :key="index" >
                <img style="width:100px" :src="`storage/uploads/`+image.name">
            </li>
        </ul>


    </div>
 </template>

 <script>
 export default {
     data(){
         return{
             file_name:"",
             images:""
         }
     },
      computed:{

     },
     mounted(){
        this.getImage();
     },

     methods:{
        fileName(e){
            this.file_name = e.target.files[0]
        },

        upload(){
            var formData = new FormData;
            formData.set('file',this.file_name);
            axios.post('upload',formData)
            .then((res)=>{
               console.log(res.data);
               this.getImage();
            })
        },

        getImage(){
              axios.get('get-image')
              .then((res)=>{
                   console.log(res.data);
                   this.images = res.data;

              })
        }
     }
 }
 </script>

 <style>

 </style>
