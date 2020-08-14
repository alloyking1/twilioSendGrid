<template>
    <div class="container pt-5">
        <br /><br /><br />
        <div class="card p-5">
            <h4>Email Our Mailing List</h4>
            <small class="pb-3"
                >Sending bulk email to our mailing list contacts</small
            >
            <form v-on:submit.prevent="send">
                <div class="form-group">
                    <!-- <input
                        type="email"
                        class="form-control"
                        placeholder="Enter email address seperated with corma"
                        v-model=""
                    /> -->
                </div>
                <div class="form-group">
                    <textarea
                        class="form-control"
                        placeholder="Enter email body"
                        v-model="data.emailBody"
                    ></textarea>
                </div>
                <button type="submit" class="btn btn-outline-success">
                    Send Emails
                </button>
            </form>
            <div class="pt-3 btn-outline-danger">
                {{ this.error }}
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
export default {
    data() {
        return {
            data: {},
            error: ""
        };
    },

    methods: {
        send() {
            if (this.data.emailBody != "") {
                axios.post("api/email/send", this.data);
            }
            this.error = "This field is required";
        }
    }
};
</script>
