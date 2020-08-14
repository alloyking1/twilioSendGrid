<template>
    <div class="container pt-5">
        <br /><br /><br />
        {{ this.success }}
        <div class="card p-5">
            <h4>Email Our Mailing List</h4>
            <small class="pb-3"
                >Sending bulk email to our mailing list contacts using Twilio
                SendGrid</small
            >
            <form v-on:submit.prevent="send">
                <div class="form-group">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Topic"
                        v-model="data.emailTopic"
                    />
                </div>
                <div class="form-group">
                    <input
                        type="email"
                        class="form-control"
                        placeholder="Sender Email"
                        v-model="data.senderEmail"
                    />
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
            <div class="pt-3 danger">
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
            error: "",
            success: ""
        };
    },

    methods: {
        send() {
            if (this.data.emailBody != "") {
                axios.post("api/email/send", this.data).then(res => {
                    this.success = "Emails sent successfully";
                });
            } else {
                this.error = "This field is required";
            }
        }
    }
};
</script>
