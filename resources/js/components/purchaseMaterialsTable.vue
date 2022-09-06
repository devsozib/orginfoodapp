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
                            <li>


                                     <ul>
                                        <li>
                                            <input type="date" class="form-control">
                                        </li>

                                        <li>
                                          <input type="date" class="form-control">
                                        </li>




                                     </ul>



                               </li>


                        </ul>
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
                            <tbody>


                                <tr>
                                    <th scope="row">1</th>
                                    <td>Milk</td>
                                    <td>New</td>
                                    <td>100</td>
                                    <td>80</td>
                                    <td>8000</td>
                                    <td>today</td>

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
    name: 'purchaseMaterialsTable'
}
</script>

<style>

</style>
