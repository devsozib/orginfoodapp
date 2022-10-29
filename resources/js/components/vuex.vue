<template>
   <div>
      <input type="text" name="" v-model="name"/><button @click="addName()">Add</button>
        <ul>
            <li v-for="(item,index) in bookList" :key="index">
            {{ item }}
            <button @click="removeItem(index)">Delete</button>
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
            this.$store.dispatch("addBook",this.name);
        },

        removeItem(index){
            this.$store.dispatch('removeItem',index);
        }
    }
}
</script>

<style>

</style>
