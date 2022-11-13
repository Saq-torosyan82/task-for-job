<template>
    <!-- The Modal -->
    <div  id="studentModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Student Modal</h4>
                    <button type="button" class="btn-close" @click="hideModal"></button>
                </div>

                <!-- Modal body -->
                <form :onSubmit="saveData">
                <div class="modal-body">
                    
                        <div class="mb-3 mt-3">
                            <label for="first_name" class="form-label">First Name *:</label>
                            <input
                                id="first_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter first name"
                                :value="selectedStudent.first_name || ''"
                            >
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="last_name" class="form-label">Last Name *:</label>
                            <input
                                id="last_name"
                                type="text"
                                class="form-control"
                                placeholder="Enter last name"
                                :value="selectedStudent.last_name || ''"
                            >
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email *:</label>
                            <input
                                id="email"
                                type="email"
                                class="form-control"
                                placeholder="Enter email"
                                :value="selectedStudent.email || ''"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number *:</label>
                            <input
                                id="phone_number"
                                type="text"
                                class="form-control"
                                placeholder="Enter phone number"
                                :value="selectedStudent.phone_number || ''"
                            >
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth *:</label>
                            <input
                                id="dob"
                                type="text"
                                class="form-control"
                                placeholder="Enter date of birth"
                                :value="selectedStudent.dob || ''"
                            >
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sports</label>
                            <div class="sports-list">
                                <div v-for="sport in sports" :key="sport.id" class="form-check">
                                    <label class="form-check-label">
                                    <input
                                        :id="`sport_${sport.id}`"
                                        type="checkbox"
                                        v-model="selectedSports"
                                        class="form-check-input"
                                        :value="sport.id"
                                        :checked="selectedStudent && selectedStudent.sportsIds && selectedStudent.sportsIds.includes(sport.id)"
                                    >
                                    {{ sport.name }}</label>
                                </div>
                            </div>
                        </div>
                    
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-danger" @click="hideModal">Close</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</template>

<script>
import { Modal } from 'bootstrap'
import axios from "axios";

export default {
    name: "StudentModal",
    props: {
        showModal: {
            type: Boolean,
            default: false
        },
        selectedStudent: {
            type: Object,
            default: {}
        }
    },
    data(){
        return {
            sports: Array,
            selectedSports: []
        }
    },
    created() {
        this.getSports()
    },
    methods:{
        modalActive: function () {
            this.modalInstance = new Modal(document.getElementById('studentModal'), {
                target: "#studentModal",
                backdrop: "static"
            });
            this.modalInstance.show()
        },
        hideModal: function () {
            console.log("closed");
            this.modalInstance.hide();
            this.$emit('closeModal');
        },
        async getSports() {
            const url = 'http://127.0.0.1:8000/api/sports';

            await axios.get(url).then(response => {
                console.log('response = ',response)
                this.sports = response.data
            }).catch(error => {
                console.log(error)
            })
        },
        async saveData(event) {
            event.preventDefault();
            const url = 'http://127.0.0.1:8000/api/sports';
            let id = this.selectedStudent.id || 0;
console.log("id = ", id);
console.log("selectedSports = ", this.selectedSports);
            const data = {
                first_name: document.getElementById('first_name').value,
                last_name: document.getElementById('last_name').value,
                email: document.getElementById('email').value,
                dob: document.getElementById('dob').value,
                phone_number: document.getElementById('phone_number').value,
                sports: this.selectedSports
            }

            console.log("data = ", data);

            /*await axios.get(url).then(response => {
                console.log('response = ',response)
                this.sports = response.data
            }).catch(error => {
                console.log(error)
            })*/
        },
    },
    watch: {
        showModal(newValue, oldValue) {
            console.log("showModal");
            console.log("newValue = ",newValue);
            console.log("oldValue = ",oldValue);
            if (newValue === true) {
                this.modalActive();
            }
        },
    },
    mounted() {
        console.log("Student modal mounted")
    }
}
</script>

<style scoped>
.sports-list {
    overflow: auto;
    height: 110px;
}

.sports-list label {
    cursor: pointer;
}

.sports-list .form-check {
    padding-left: 2.5em;
}
</style>
