import { createStore } from "vuex";

const store = createStore({
    state:{
        bookList:[]
    },

    mutations:{
        addBookName(){
                 
        }
    },

    actions:{
         addBook(context, data){
            context.commit("addBookName", data)

         }
    }


});

export default store;
