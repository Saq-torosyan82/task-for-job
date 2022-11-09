<template>
    <div class="container mt-5">
        <div class="row">
            <button type="button" class="btn btn-primary w-25 mb-2" @click="create">Create</button>
        </div>
        <div class="row">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Date of Birth</th>
                        <th>Favorite sports</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.first_name }}</td>
                        <td>{{ student.last_name }}</td>
                        <td>{{ student.email }}</td>
                        <td>{{ student.phone_number }}</td>
                        <td>{{ student.dob }}</td>
                        <td class="sports-filed">
                            <span v-for="sport in student.student_sports" :key="sport.id" class="badge bg-primary ms-1">{{ sport.name }}</span>
                        </td>
                        <td>
                            <button type="button" class="btn btn-warning" @click="edit">Edit</button>
                            <button type="button" class="btn btn-danger ms-5" @click="deleteStudent">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <StudentModal @closeModal="closeStudentModal" :showModal="showStudentModal"></StudentModal>
    <DeleteStudentModal @closeModal="closeDeleteStudentModal" :showModal="showDeleteStudentModal"></DeleteStudentModal>
</template>

<script>
import axios from 'axios';
import StudentModal from "../components/StudentModal";
import DeleteStudentModal from "../components/DeleteStudentModal";

export default {
    name: "Students",
    components: {
        StudentModal,
        DeleteStudentModal
    },
    data() {
        return {
            students: Array,
            /* this data is used for showing modal */
            showStudentModal: false,
            showDeleteStudentModal: false
        }
    },
    created() {
        console.log("Students page created")
        this.getStudents()
    },
    methods: {
        async getStudents() {
            const url = 'http://127.0.0.1:8000/api/students';

            await axios.get(url).then(response => {
                this.students = response.data
            }).catch(error => {
                console.log(error)
            })
        },
        closeStudentModal() {
            this.showStudentModal = false
        },
        create() {
            this.showStudentModal = true
        },
        edit() {
            this.showStudentModal = true
        },
        deleteStudent() {
            this.showDeleteStudentModal = true
        }
    },
    mounted() {
        console.log("Students page mounted")
    }
}
</script>

<style scoped>
    .sports-filed {
        max-width: 200px;
    }
</style>
