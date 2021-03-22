<template>
  <div>
    <ul>
      <EmployeeItems v-for="employee in employees" :key="employee.id" :employee="employee" />
    </ul>
  </div>
</template>

<script>
import data from "../employee-data.json";
import EmployeeItems from "../components/EmployeeItems"


export default {
  components: {
    EmployeeItems
  },
  data(){
    return {
      employees: []
    }
  },
  mounted() {
    this.employees = data.employees;
  }
};
</script>

<style>
</style>