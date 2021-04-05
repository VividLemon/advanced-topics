<template>
        <div>
            <role-drop-down :roles="testRoles" :user="testUser" />
            this.user.roleId: {{ testUser.roleId}}
            <p>This demonstrates that mutating a prop in a child component can affect a parent, and you may not want that!</p>
        </div>
    </template>

    <script>

    import RoleDropDown from '../src/components/RoleDropDown.vue'

    export default {
        components: { RoleDropDown },
        data(){
            return {
                testRoles:[
                    {
                        "id": "1",
                        "name": "Standard User",
                        "description": "Normal user with no special permissions"
                    },
                    {
                        "id": "2",
                        "name": "Admin",
                        "description": "Extra permissions"
                    }
                ],
                testUser: {
                        "id":"1",
                        "firstName":"Joexxxxxxx",
                        "lastName":"Smith",
                        "email":"joe@smith.com",
                        "roleId":"1",
                        "password":"opensesame",
                        "salt":"xxx",
                        "active":"yes"
                }
            }
        }
    }
    </script>
