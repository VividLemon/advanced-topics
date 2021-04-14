 <template>
        <tr>
            <td>{{user.user_first_name + " " + user.user_last_name }}</td>
            <td>{{user.user_email}}</td>
            <td>
                <role-drop-down :user="user" :roles="$root.userRoles" @user-updated="$emit('user-updated', $event)"/>
            </td>
            <td>
                <active-check-box :user="user" @user-updated="$emit('user-updated', $event)" />
            </td>
            <td>
                <button @click="$emit('user-selected', user)">Edit</button>
            </td>
        </tr>
</template>

    <script>

    import RoleDropDown from './RoleDropDown.vue'
    import ActiveCheckBox from './ActiveCheckBox.vue'

    export default {
  components: { RoleDropDown, ActiveCheckBox },
        props:{
            user: {
                type: Object
            }
        },
        
    }
    </script>