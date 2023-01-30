<template>
  <div>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th v-if="superAdminCheck > 0">Branch</th>
                <th>Production Qty</th>
                <th>Raw Materials Qty</th>
                <th>Unit</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody v-if="productions.length > 0">
            <tr v-for="(item,index) in productions" :key="index">
                <th scope="row">{{ index+1 }}</th>
                <td>{{ item.product_name }}</td>
                <td v-if="superAdminCheck > 0">{{ item.branch_name }}</td>
                <td>{{ item.production_qty }}</td>
                <td>{{ item.raw_materials_qty }}</td>
                <td>{{ item.unit }}</td>
                <td>{{ item.date }}</td>
                <td>...</td>
            </tr>
        </tbody>
    </table>
  </div>
</template>

<script>
export default {
   data(){
    return{
        srs:[]
    }
   },

   methods:{
      getSrs(){
        axios.get
      }
   }
}
</script>

<style>

</style>
