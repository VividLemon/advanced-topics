import axios from 'axios'

const ax = axios.create({
    baseURL: 'http://localhost/api/'
});

const UserDataAccess = {
    getAllUsers(){
        return ax.get("users/")
    },
    insertUser(user){
        return ax.post("users/", user).catch((error) => errorHandler("Error Updating User:" + error));
    },
    updateUser(user){
        return ax.put("users/" + user.id, user).catch((error) => errorHandler("Error Inserting User:" + error));
    }
}

const RoleDataAccess = {
    getAllRoles(){
        return ax.get("roles/")
    }
}

function errorHandler(msg){
    alert(msg);
}

export {UserDataAccess, RoleDataAccess}