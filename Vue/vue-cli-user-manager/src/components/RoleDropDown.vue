<template>
        <select @change="handleChange">
            <option v-for="r in roles" :key="r.id" :value="r.id" :selected="r.id == user.roleId">
                {{ r.name }}
            </option>
        </select>
</template>

    <script>
    export default {
        props:{
            user: {
                type: Object
            },
            roles: {
                type: Array
            }
        },
         methods:{
            handleChange(evt){
                //alert(evt.target.value);
                //this.user.roleId = evt.target.value;
                //this.$emit("user-updated", this.user);

                const userCopy = {...this.user};
                userCopy.roleId = evt.target.value;
                this.$emit("user-updated", userCopy);
            }
    }
    }
    </script>