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
                firstName: this.user?.user_first_name ?? "",
                lastName: this.user?.user_last_name ?? "",
                email: this.user?.user_email ?? "",
                roleId:  this.user?.user_roleId ?? 1, // Default to Standard User - this smells!
                password: this.user?.user_password ?? "",
                active:  this.user?.user_active ?? "yes", // new users will default to 'active'
                errors: {} // This will be for input validation error messages
            }
        },
        methods: {
            onSubmit() {
            
                if(this.validate()){
                
                    const updatedUser = {
                        id: this.id,
                        firstName: this.firstName,
                        lastName: this.lastName,
                        email: this.email,
                        roleId: this.roleId,
                        password: this.password,
                        active: this.active
                    };

                    this.$emit("user-updated", updatedUser);
                }
            },
            handleCancel(){
                this.$emit("user-form-cancelled");
            },
            handleRoleUpdate(user){
            this.roleId = user.roleId;
            },
            handleActiveUpdate(user){
                this.active = user.active;
            },
            validate() {

            // clear our any error messages from the previous submit
            this.errors = {};

            if (!this.firstName) {
                this.errors.firstName = "First name is required";
            }

            if (!this.lastName) {
                this.errors.lastName = "Last name is required";
            }

            const emailRegExp = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (!this.email) {
                this.errors.email = "Email is required";
            }else if(emailRegExp.test(this.email) == false){
                this.errors.email = "The email address is not valid";
            }

            if (!this.password) {
                this.errors.password = "Password is required";
            }

            // if there are no keys in the errors object, then everything is valid
            return Object.keys(this.errors).length == 0;
            }
        }
    }
    </script>

    <style scoped lang="scss">
        label, .validation{ display: block; }
    </style>
