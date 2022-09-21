import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler';
// import { createApp } from 'vue';


const app = createApp({});

import purchaseMaterialsTable from './components/purchaseMaterialsTable.vue';
import allProduction from './components/allProduction.vue';

app.component('purchase-materials-table', purchaseMaterialsTable);
app.component('all-production', allProduction);


app.mount('#app');
