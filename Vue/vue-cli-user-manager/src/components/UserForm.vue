<template>
        <div class="user-form-container">
            <form @submit.prevent="onSubmit">
                <div>
                    <label>First Name:</label>
                    <input v-model="firstName" />
                    <span class="validation" v-if="errors.firstName">{{errors.firstName}}</span>
                </div>
                <div>
                    <label>Last Name:</label>
                    <input v-model="lastName" />
                    <span class="validation" v-if="errors.lastName">{{errors.lastName}}</span>
                </div>
                <div>
                    <label>Email:</label>
                    <input v-model="email" />
                    <span class="validation" v-if="errors.email">{{errors.email}}</span>
                </div>
                <div>
                    <label>Role:</label>
                    <role-drop-down :roles="$root.userRoles" :user="user" @user-updated="handleRoleUpdate" />
                </div>
                <div>
                    <label>Password:</label>
                    <input type="password" v-model="password" />
                    <span class="validation" v-if="errors.password">{{errors.password}}</span>
                </div>
                <div>
                 <active-check-box :user="user" @user-updated="handleActiveUpdate" />
                </div>
                <div>
                    <input type="submit" id="btnSubmit" name="submit button">
                    <input type="button" @click="handleCancel" value="Cancel">
                </div>
            </form>
        </div>
</template>

    <script>
    import ActiveCheckBox from './ActiveCheckBox.vue';
    import RoleDropDown from './RoleDropDown.vue';

    export default {
        components: { RoleDropDown, ActiveCheckBox },
        props: {
            user: {
                type: Object
            }
        },
        data() {
            return {
                id: this.user?.id ?? 0,
                firstName: this.user?.firstName ?? "",
                lastName: this.user?.lastName ?? "",
                email: this.user?.email ?? "",
                roleId:  this.user?.roleId ?? 1, // Default to Standard User - this smells!
                password: this.user?.password ?? "",
                active:  this.user?.active ?? "yes", // new users will default to 'active'
                errors: {} // This will be for input validation error messages
            }
        },
        methods: {
            onSubmit() {
                const updatedUser = {
                    id: this.id,
                    firstName: this.firstName,
                    lastName: this.lastName,
                    email: this.email,
                    roleId: this.roleId,
                    password: this.password,
                    active: this.active
                }
                this.$emit("user-updated", updatedUser);
                
            },
            handleCancel(){
                this.$emit("user-form-cancelled");
            },
            handleRoleUpdate(user){
            this.roleId = user.roleId;
            },
            handleActiveUpdate(user){
                this.active = user.active;
            }
        }
    }
    </script>

    <style scoped lang="scss">
        label, .validation{ display: block; }
    </style>
