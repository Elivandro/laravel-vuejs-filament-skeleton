import { createStore } from 'vuex';
import tenants from './modules/tenants';

const store = createStore({
    modules: {
        tenants,
    }
});

export default store;
