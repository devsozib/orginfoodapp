<template>
    <div>
    <div class="body">
        <form id="form_validation" @submit.prevent="sendNotification"  method="post" action="">
            <div class="body">
                <div class="row clearfix">
                    <div class="col-sm-6">
                        <div class="form-line">
                            <label class="">Products</label>
                            <select id="unit"  v-model="product_id" class="form-control" name="product_id">
                                <option value="" selected hidden disabled>-- Please select --</option>
                                <option v-for="(product,index) in products" :key="index" :value="product.id">
                                {{ product.name }}
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-line">
                            <label class="">Branch</label>
                            <select id="unit" v-model="branch_id" class="form-control" name="branch_id" >
                                <option value="" selected hidden disabled>-- Please select --</option>
                                <option v-for="(branch,index) in branches" :key="index" :value="branch.id">
                                {{ branch.name }}
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <label class="">Quantity</label>
                        <input v-model="qty" type="number" class="form-control" placeholder="Quantity" name="qty" required>
                    </div>

                    <div class="col-sm-6">
                        <label class="">Your need in date</label>
                        <input v-model="in_need_date" type="date" class="form-control" placeholder="Quantity" name="date" required>
                    </div>

                </div>
                <button class="btn btn-primary waves-effect" type="submit">SUBMIT</button>
            </div>

        </form>
    </div>
    </div>
    </template>

    <script>
import axios from 'axios';



    export default {

        name: 'notificationSend',

        data() {
            return {
               products:[],
               branches:[],
               branch_id:"",
               product_id:"",
               qty:"",
               in_need_date:""
            };
        },

        mounted() {
             this.getDatas();
        },
        methods: {
           getDatas(){
             axios.get('for-notification-data')
             .then((res)=>{
                //   console.log(res.data);
                this.products = res.data[0];
                this.branches = res.data[1];
             })
           },

           sendNotification(){
               axios.post('send-notification',
               {
                notification:{
                    product_id:this.product_id,
                    branch_id:this.branch_id,
                    qty:this.qty,
                    in_need_date:this.in_need_date
                }
               })
               .then((res)=>{
                 this.product_id = {}
                 this.branch_id = {}
                 this.qty = {}
                 this.in_need_date = {}
               })
           },


        },

    }
    </script>

    <style>

    </style>
