<template>
        <div>
            <div v-if="!selectedUser" class="user-list">
                <h1>Users</h1>
                    <button @click="selectedUser = {}"> Add New User</button>
                    <user-list 
                        :users="users" 
                        @user-updated="handleUserUpdated" 
                        @user-selected="handleUserSelected" />
            </div>
            <div v-else class="user-form">
                 <user-form 
                    :user="selectedUser" 
                    @user-form-cancelled="selectedUser = null"
                    @user-updated="handleUserUpdated" />
            </div>
        </div>  
</template>

    <script>

    import {UserDataAccess as da} from "@/api"
    import UserList from '../components/UserList.vue'
    import UserForm from '../components/UserForm.vue'
   

export default {
    components: { UserList, UserForm },
    data(){
        return {
            users: [],
            selectedUser: null
        }
    },
    mounted(){
        if(this.$root.currentUserRoleId != 2){
            // You muse be an admin (role id 2) to view this page
            this.$router.push({name: "Login"});
        }
        da.getAllUsers()
        .then(response => {
            console.log(response.data);
            this.users = response.data
        })
        .catch(error => console.log(error));
    },
    methods:{
        handleUserUpdated(user){
        if(user.id){
               da.updateUser(user).then(resp => {
                // get the index of the user to replace
                const indexOfUser = this.users.findIndex(u => u.id === user.id);
                // this.users[indexOfUser] = user; // this would work if Vue truely was reactive!!!
                this.$set(this.users, indexOfUser, user);
    });
        }else{
             da.insertUser(user).then(resp => {
            const newUser = resp.data;
            this.$set(this.users, this.users.length, user);
    });
      }
        },
        handleUserSelected(user){
            console.log("User selected...", user);
            this.selectedUser = user;  // we'll uncomment this in a minute
        }
    }
}
    </script>