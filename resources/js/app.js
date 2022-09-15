import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import purchaseMaterialsTable from './components/purchaseMaterialsTable.vue';
import allProduction from './components/allProduction.vue';

app.component('purchase-materials-table', purchaseMaterialsTable);
app.component('all-production', allProduction);


app.mount('#app');
