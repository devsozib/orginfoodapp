import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue/dist/vue.esm-bundler';
import store from './store/index';
// import { createApp } from 'vue';


const app = createApp({});

import purchaseMaterialsTable from './components/purchaseMaterialsTable.vue';
import allProduction from './components/allProduction.vue';
import fileUpload from './components/file_upload.vue';

app.component('purchase-materials-table', purchaseMaterialsTable);
app.component('all-production', allProduction);
// app.component('vue-x', vueEx);
app.component('file-upload', fileUpload);

app.use(store)
app.mount('#app');

