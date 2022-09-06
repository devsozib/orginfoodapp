import './bootstrap';
import { createApp } from 'vue';


const app = createApp({});

import purchaseMaterialsTable from './components/purchaseMaterialsTable.vue';

app.component('purchase-materials-table', purchaseMaterialsTable);


app.mount('#app');
