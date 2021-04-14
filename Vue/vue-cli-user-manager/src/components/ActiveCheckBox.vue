<template>
 <label>
            <input type="checkbox" :checked="user.user_active == 'yes' ? true : false" @change="handleChange" />
            Active
        </label>
</template>

<script>
export default {
    props:{
        user: {
            type: Object
        }
    },
    methods:{
        handleChange(evt){
            //alert(evt.target.checked);
            //this.user.active = evt.target.checked ? "yes" : "no";
            //this.$emit("user-updated", this.user);

            const userCopy = {...this.user}
            userCopy.active = evt.target.checked ? "yes" : "no";
            this.$emit("user-updated", userCopy);
        }
    }
}
</script>

