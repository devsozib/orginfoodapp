<template>
<div class="body table-responsive">
    <div>
        <p>From <input v-model="fromDate" v-on:change="getProduction('date')" name="fromDate" type="date" />To <input v-model="toDate" v-on:change="getProduction('date')" name="toDate" type="date" /></p>

        <select v-model="filter_by" name="filter_by" v-on:change="getProduction('dropdown')" class="form-control" style="width:100px; float:right">
            <option value="" disabled selected hidden>Filter By</option>
            <option value="all">All</option>
            <option value="today">Today</option>
            <option value="this_week">This week</option>
            <option value="this_month">This month</option>
            <option value="this_year">This Year</option>
        </select>
    </div>
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
    name: "allProduction",
    data() {
        return {
            productions: [],
            superAdminCheck: [],
            fromDate: "",
            toDate: "",
            filter_by:""
        }
    },

    mounted() {
        this.getProduction('date');
    },

    methods: {
        getProduction(searchItem) {
            axios.get('search-production',{
                params:{
                    fromDate: this.fromDate,
                    toDate:this.toDate,
                    filterBy:this.filter_by,
                    searchValue: searchItem,
                }
            })
                .then((res) => {

                    this.productions = res.data.productions,
                        this.superAdminCheck = res.data.superAdmin
                })
                // .then(res => console.log(res.data))
                .catch(error => {})
        },
    }
}
</script>

<style>

</style>
