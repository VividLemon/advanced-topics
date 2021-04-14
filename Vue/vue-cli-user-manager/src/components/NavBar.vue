<template>
    <div id="nav">
        <router-link to="/">Home</router-link> |
        <router-link to="/about">About</router-link> |
        <span v-if="$root.currentUser">
            <router-link v-if="$root.currentUserRoleId == 2" :to="{name: 'Users'}">Users</router-link> |
            <router-link :to="{name: 'Account'}">Your Account</router-link> |
            <a href="#" @click="logout">Logout</a> |
        </span>
        <span v-else>
            <router-link :to="{name: 'Login'}">Login</router-link>
        </span>
        
    </div>
</template>

<script>
export default {
    methods:{
        logout(){
            this.$router.push({name:"Login"});
        }
    }
}
</script>