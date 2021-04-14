<template>
    <div>
        <user-form :user="user" @user-updated="handleUpdate" @user-form-cancelled="handleCancel" :key="user.id" />
    </div>
</template>

<script>
import UserForm from "../components/UserForm.vue"
import {UserDataAccess as da} from "@/api"

export default {
    components: { UserForm },
    data(){
        return {
            user:{}
        }
    },
    mounted(){
        if(this.$root.currentUserId){
            da.getUserById(this.$root.currentUserId).then(resp => this.user = resp.data );
        }else{
            this.$router.push({name:"Login"});
        }
    },
    methods:{
        handleUpdate(user){
            da.updateUser(user).then(resp => this.$router.push({name:"Home"}));
        },
        handleCancel(){
            this.$router.push({name:"Home"});
        }
    }
}
</script>