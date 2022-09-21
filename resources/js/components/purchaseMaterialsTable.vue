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
                            <a class="btn-sm btn-primary float-right" :href="this.routeName">Purchase Materials</a>
                        </ul>
                    </div>
                    <div class="body table-responsive">
                        <div>
                            <p>From <input v-model="fromDate" v-on:change="getResults('date')" name="fromDate" type="date" />To <input v-model="toDate" v-on:change="getResults('date')" name="toDate" type="date" /></p>

                            <select v-model="filter_by" name="filter_by" v-on:change="getResults('dropdown')" class="form-control" style="width:100px; float:right">
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
                                    <th>NAME</th>
                                    <th>Vendor</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Purchase Date</th>

                                </tr>
                            </thead>
                            <tbody v-if="results.length > 0">
                                <tr v-for="(item, index) in results" :key="item.id">
                                    <th scope="row">{{ index+1 }}</th>
                                    <td>{{ item.item_name }}</td>
                                    <td>{{ item.vendor_name }}</td>
                                    <td>{{ item.qty }}</td>
                                    <td>{{ item.price }}</td>
                                    <td>{{ item.price*item.qty }}</td>
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


export default {

    name: 'purchaseMaterialsTable',

    data() {
        return {
            fromDate: "",
            toDate: "",
            filter_by: "",
            results: [],
            routeName: "/purchase-materials",
            recordNotFound: true

        };
    },
    // watch: {
    //     keyword(after, before) {
    //         this.getResults('date');
    //     }
    // },
    mounted() {
        this.getResults('date');
    },
    methods: {
        getResults(searchItem) {
            axios.get('search-data', {
                    params: {
                        fromDate: this.fromDate,
                        toDate: this.toDate,
                        filterBy: this.filter_by,
                        searchValue: searchItem,
                    }
                })
                .then((res) => {
                    this.results = res.data
                })
                //   .then(res => console.log(res.data))
                .catch(error => {});
        },

    },

}
</script>

<style>

</style>
