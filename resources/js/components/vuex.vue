<template>
   <div>
      <input type="text" name="" v-model="name"/><button @click="addName()">Add</button>
        <ul>
            <li v-for="(item,index) in bookList" :key="index">
            {{ item }}
            </li>
        </ul>
   </div>
</template>

<script>
export default {
    data(){
        return{
            name:""
        }
    },
     computed:{
        bookList(){
            return this.$store.state.bookList;
        }
    },

    methods:{

        addName(){
            alert(this.name);
        }
    }
}
</script>

<style>

</style>
