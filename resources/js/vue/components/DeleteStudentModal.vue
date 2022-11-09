<template>
    <!-- The Modal -->
    <div  id="deleteStudentModal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Delete Student</h4>
                    <button type="button" class="btn-close" @click="hideModal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    Modal body..
                </div>

                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" @click="hideModal">Delete</button>
                    <button type="button" class="btn btn-danger" @click="hideModal">Close</button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
import {Modal} from "bootstrap";

export default {
    name: "DeleteStudentModal",
    props: {
        showModal: {
            type: Boolean,
            default: false
        }
    },
    data(){
        return{
            OpenClose:this.visible
        }
    },
    methods:{
        modalActive: function () {
            this.modalInstance = new Modal(document.getElementById('deleteStudentModal'), {
                target: "#deleteStudentModal",
                backdrop: "static"
            });
            this.modalInstance.show()
        },
        hideModal: function () {
            console.log("closed");
            this.modalInstance.hide();
            this.$emit('closeModal');
        }
    },
    watch: {
        showModal(newValue, oldValue) {
            console.log("newValue = ",newValue);
            console.log("oldValue = ",oldValue);
            if (newValue === true) {
                this.modalActive();
            }
        }
    }
}
</script>

<style scoped>

</style>
