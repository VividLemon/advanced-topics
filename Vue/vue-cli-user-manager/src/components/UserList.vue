<template>
        <div class="user-list">
            <table border="1">
                <tr>
                    <th>User</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Active</th>
                    <th></th>
                </tr>
                <user-list-row 
                    v-for="u in users" 
                    :key="u.id" 
                    :user="u" 
                    @user-updated="$emit('user-updated', $event)" 
                    @user-selected="$emit('user-selected', $event)"/>
            </table>
        </div>
</template>




    <script>
  import UserListRow from './UserListRow.vue'


    export default {
        components: { UserListRow },
        props: {
            users:{
                type: Array
            }
        }
    }
  
    </script>