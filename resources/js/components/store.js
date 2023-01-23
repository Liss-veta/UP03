import { createStore } from "vuex";
export default createStore({
    state() {
        return {
            avatar: '',
            user: {
                id: 0,
                name: '',
                surname: '',
                email: '',
                adress: '',
                number: '',
                age: '',
                city: ''
            },
            isFocusRoom: false,
            focusRooM: {},
        }
    },
    mutations: {

    }
})