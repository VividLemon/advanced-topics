<template>
    <div class="login">
        <form @submit.prevent="onSubmit">
            <span class="validation">{{errors.login}}</span>
            <!-- I'm not sure why the errors.login isn't showing up!!! -->
            <div>
                <label>Email:</label>
                <input v-model="email" />
                <span class="validation" v-if="errors.email">{{errors.email}}</span>
            </div>
            <div>
                <label>Password:</label>
                <input type="password" v-model="password" />
                <span class="validation" v-if="errors.password">{{errors.password}}</span>
            </div>
            <div>
                <input type="submit" id="btnSubmit" name="submit button">
            </div>
        </form>
    </div>
</template>

<script>
import {UserDataAccess as da} from "@/api"
export default {
    data(){
        return {
            email: "",
            password: "",
            // errors: {}
            errors: {email:"", password:"", login:""}
        }
    },
    mounted(){
        // When a user comes to this page, log them out (because that are about to login)
        this.$root.currentUser = "";
        this.$root.currentUserRoleId = 0;
        this.$root.currentUserId = 0;
    },
    methods: {
        onSubmit(){
            if(this.validate()){
                da.login(this.email, this.password)
                    .then((resp) => {
                        this.$root.currentUser = resp.data.user_email;
                        this.$root.currentUserRoleId = resp.data.user_roleId;
                        this.$root.currentUserId = resp.data.id;
                        this.$router.push({name: "Home"});
                    })
                    .catch((error) => {
                        this.errors = {};
                        //alert("Unable to authenticate"); // this is LAME!!!
                        this.errors.login = error; // why is this not reactive???
                        // this.$set(this.errors, "login", error); // this doesn't work either
                    });
            }
        },
        validate(){
            
            var isValid = true;
            this.errors = {};
            if(this.email == ""){
                this.errors.email = "Enter your login email";
                isValid = false;
            }
            if(this.password == ""){
                this.errors.password = "Enter your password";
                isValid = false;
            }
            return isValid;
        }
    }
}
</script>
<style scoped lang="scss">
    label, .validation{ display: block; }
    .validation{color: red; }
</style>