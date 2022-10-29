import { createStore } from "vuex";

const store = createStore({
    state:{
        bookList:[]
    },

    mutations:{
        addBookName(state, data){
               state.bookList.push(data);
        }
        ,
        removeItem(state, data){
             this.bookList.pop(data);
        }
    },

    actions:{
         addBook({commit}, data){
               commit("addBookName", data)

         },
         removeItem({commit},data){
                commit('removeItem'.data)
         }
    }


});

export default store;
