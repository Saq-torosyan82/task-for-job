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
                <div class="modal-body">
                    <form id="studentForm">
                        <div class="mb-3 mt-3">
                            <label for="first_name" class="form-label">First Name *:</label>
                            <input id="first_name" type="text" class="form-control" placeholder="Enter first name" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="last_name" class="form-label">Last Name *:</label>
                            <input id="last_name" type="text" class="form-control" placeholder="Enter last name" required>
                        </div>
                        <div class="mb-3 mt-3">
                            <label for="email" class="form-label">Email *:</label>
                            <input id="email" type="email" class="form-control" placeholder="Enter email" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number *:</label>
                            <input id="phone_number" type="text" class="form-control" placeholder="Enter phone number" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth *:</label>
                            <input id="dob" type="text" class="form-control" placeholder="Enter date of birth" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Sports</label>
                            <div class="sports-list">
                                <div v-for="sport in sports" :key="sport.id" class="form-check">
                                    <input :id="`sport_${sport.id}`" type="checkbox" class="form-check-input" :value="sport.id">
                                    <label class="form-check-label" :for="`sport_${sport.id}`">{{ sport.name }}</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="hideModal">Save</button>
                    <button type="button" class="btn btn-danger" @click="hideModal">Close</button>
                </div>

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
        }
    },
    data(){
        return {
            sports: Array,
        }
    },
    created() {
        console.log("Student modal created")
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
    },
    watch: {
        showModal(newValue, oldValue) {
            console.log("newValue = ",newValue);
            console.log("oldValue = ",oldValue);
            if (newValue === true) {
                this.modalActive();
            }
        }
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
