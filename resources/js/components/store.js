import { createStore } from "vuex";
export default createStore({
    state() {
        return {
            avatar: '',
            user: {
                name: '',
                surname: '',
                email: '',
                adress: '',
                number: '',
                age: '',
                city: ''
            }
        }
    },
    mutations: {

    }
})