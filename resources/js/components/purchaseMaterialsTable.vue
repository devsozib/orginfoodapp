<template>
    <div>
        <div class="container-fluid">
        <div class="block-header">
            <h2> All Materials List</h2>
        </div>
        <!-- Basic Table -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            All Materials List
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <a class="btn-sm btn-primary float-right" href="">Purchase Materials</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <ul class="header-dropdown m-r--5">

                        </ul>
                        <input v-model="keyword" type="text" class="form-control" name="keyword" placeholder="Search">
                        <p>From <input v-model="fromDate" name="fromDate" type="date"/>To <input v-model="toDate" name="toDate" type="date"/> </p>
                        <input type='button' @click='fetchRecords()' value='Search'>
                        <table class="table">

                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>Vendor</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Purchase Date</th>

                                </tr>
                            </thead>
                            <tbody v-if="results.length > 0">
                                <tr v-for="item in results" :key="item.id">
                                    <th scope="row">{{ item.id }}</th>
                                    <td>{{ item.item_name }}</td>
                                    <td>{{ item.vendor_name }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.date }}</td>
                                </tr>


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Table -->

    </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default {

    name: 'purchaseMaterialsTable',

    data(){
        return{
            keyword: null,
            fromDate: "",
            toDate: "",
            results:[],
            recordNotFound: true

        };
    },
    watch: {
        keyword(after, before) {
            this.getResults();
        }
    },
    mounted(){
        this.getResults();
    },
    methods:{
          getResults(){
              axios.get('/search-data', {params:{keyword:this.keyword}})
              .then(res => this.results = res.data)
              .catch(error => {});
          },

          fetchRecords(){
            if(this.fromDate !='' && this.toDate != ''){

                axios.get('/date-wise', {
                params: {
                fromDate: this.fromDate,
                toDate: this.toDate
                }
                })
                .then(function (response) {
                  this.results = response.data;
                if(results.length == 0){
                    this.recordNotFound = true;
                }else{
                    this.recordNotFound = false;
                }
                })
                .catch(function (error) {
                console.log(error);
                });

            }
          }
    },

//     methods: {
//      fetchRecords: function(){

//         if(this.fromDate !='' && this.toDate != ''){

//           axios.get('/date-wise', {
//             params: {
//               fromDate: this.fromDate,
//               toDate: this.toDate
//             }
//           })
//           .then(function (response) {
//              console.log(response.data);
//              this.results = response.data;

//              // Display no record found <tr> if record not found
//              if(results.length == 0){
//                app.recordNotFound = true;
//              }else{
//                app.recordNotFound = false;
//              }
//           })
//           .catch(function (error) {
//              console.log(error);
//           });

//         }

//      }
//    },
    components:{
        Datepicker
    }
}
</script>

<style>

</style>
