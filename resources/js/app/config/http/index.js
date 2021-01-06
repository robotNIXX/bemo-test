import Vue from 'vue';

// Axios
import axios    from 'axios';
import VueAxios from 'vue-axios';

axios.defaults.baseURL = '/api';
Vue.use(VueAxios, axios);

export default {};
