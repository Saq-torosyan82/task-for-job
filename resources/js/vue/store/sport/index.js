import { createStore } from 'vuex'
import axios from 'axios';

export default createStore({
    state: {
        students: {}
    },
    mutations: {
        UPDATE_STUDENTS (state, payload) {
            state.students = payload;
        }
    },
    actions: {
        getStudents ({ commit }) {
            axios.get(`http://127.0.0.1:8000/api/students`).then((response) => {
              commit('UPDATE_STUDENTS', response.data)
            }).catch(error => {
                console.log(error)
            });
        }
    },
    modules: {
    }
})
