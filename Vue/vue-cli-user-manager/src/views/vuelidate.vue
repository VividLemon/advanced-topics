<template>
  <div>
    <b-form @submit.stop.prevent="onSubmit">
      <b-form-group
        id="example-input-group-1"
        label="Name"
        label-for="example-input-1"
      >
        <b-form-input
          id="example-input-1"
          name="example-input-1"
          v-model="$v.form.name.$model"
          :state="validateState('name')"
        ></b-form-input>

        <b-form-invalid-feedback id="input-1-live-feedback"
          >This is a required field and must be at least 3
          characters.</b-form-invalid-feedback
        >
      </b-form-group>

      <b-form-group id="test" label="name" label-for="testing">
        <b-form-input
          id="testingname"
          name="testingname"
          v-model="$v.form.testingname.$model"
          :state="validateState('testingname')"
        ></b-form-input>
        <b-form-invalid-feedback v-if="!$v.form.testingname.required" class="invalid">req</b-form-invalid-feedback>
        <b-form-invalid-feedback v-if="!$v.form.testingname.minLength">minLength</b-form-invalid-feedback>
        <b-form-invalid-feedback v-if="!$v.form.testingname.email && $v.form.testingname.minLength">email</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group
        id="example-input-group-2"
        label="Food"
        label-for="example-input-2"
      >
        <b-form-select
          id="example-input-2"
          name="example-input-2"
          v-model="$v.form.food.$model"
          :options="foods"
          :state="validateState('food')"
          aria-describedby="input-2-live-feedback"
        ></b-form-select>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button class="ml-2" @click="resetForm()">Reset</b-button>
    </b-form>
  </div>
</template>

<style>
body {
  padding: 1rem;
}
</style>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength, email } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  data() {
    return {
      foods: [
        { value: null, text: "Choose..." },
        { value: "apple", text: "Apple" },
        { value: "orange", text: "Orange" },
      ],
      form: {
        name: null,
        food: null,
        testingname: null,
      },
    };
  },
  validations: {
    form: {
      food: {
        required,
      },
      name: {
        required,
        minLength: minLength(3),
      },
      testingname: {
        required,
        minLength: minLength(3),
        email
        
      },
    },
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    resetForm() {
      this.form = {
        name: null,
        food: null,
        testingname: null,
        //required for reactivity
      };

      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    onSubmit() {
      this.$v.form.$touch();
      if (this.$v.form.$anyError) {
        return;
      }

      alert("Form submitted!");
    },
  },
};
</script>