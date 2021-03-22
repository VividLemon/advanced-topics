<template>
    <div>
        <b-button v-b-toggle="`id-${employee.id}`" variant="primary">{{ `${employee.firstName} ${employee.lastName}`}}</b-button>
        <b-collapse :id="`id-${employee.id}`" class="mt-2">
            <b-form inline class="m-2" @submit.stop.prevent="onSubmit">
                <b-card>

                    <label class="sr-only" for="inline-form-input-name">Name</label>
                    <b-form-input
                    id="inline-form-input-name"
                    class="mb-2 mr-sm-2 mb-sm-0 needs-validation"
                    v-model="form.name"
                    :state="validateState('name')"
                    
                    ></b-form-input>

                    <label class="sr-only" for="inline-form-input-email">Email</label>
                    <b-form-input
                    id="inline-form-input-email"
                    class="mb-2 mr-sm-2 mb-sm-0 needs-validation"
                    v-model="form.email"
                    ></b-form-input>

                    <label class="sr-only" for="inline-form-input-birthdate">Name</label>
                    <b-form-input
                    id="inline-form-input-birthdate"
                    class="mb-2 mr-sm-2 mb-sm-0 needs-validation"
                    type="date"
                    v-model="date"
                    ></b-form-input>

                    <h5 v-if="employee.active == true" class="text-danger m-1">Password reset overdue!</h5>
                    <label class="sr-only text-danger" for="inline-form-input-passwordReset" v-if="employee.active == true">Reset Password: </label>
                    <b-form-input v-if="employee.active == true"
                    type="password"
                    id="inline-form-input-oldPassword"
                    class="mb-2 mr-sm-2 mb-sm-0 needs-validation"
                    placeholder="Old Password (bang)"
                    v-model="oldPass"
                    ></b-form-input>

                    <b-form-input v-if="employee.active == true"
                    type="password"
                    id="inline-form-input-newPassword"
                    class="mb-2 mr-sm-2 mb-sm-0 needs-validation"
                    placeholder="New Password"
                    v-model="newPass"
                    ></b-form-input>
                    <h1></h1>

                    <b-button type="submit" variant="primary">Submit</b-button>
                </b-card>
            </b-form>
        </b-collapse>
    </div>
</template>


<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";


export default {
    mixins: [validationMixin],
    data(){
      return {
          form: {
              name: this.employee.firstName + ' ' + this.employee.lastName,
              email: this.employee.email,
              date: this.employee.birthdate,
          }

        }
    },
    props: {
        employee: Object,
    },
    validations: {
        form: {
            name: {
                required,
                minLength: minLength(3)
            }
        }
    },
    methods:{
    init({}){
        this.name = employee.firstName;
        this.email = "ffffff";
    },
    validateState(name) {
      const { $dirty, $error } = this.form.name;
      return $dirty ? !$error : null;
    },
    resetForm() {
     
    },
    onSubmit() {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) {
        return;
      }
      alert("Form submitted!");
    }
  }
};
</script>
<!--<style lang="scss" scoped> need to install sass-loader for this version of the style tag to work-->
<style scoped>
li {
  list-style: none;
}
</style> 