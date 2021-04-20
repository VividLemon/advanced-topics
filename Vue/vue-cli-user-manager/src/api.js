import axios from 'axios'

const devUrl = "http://localhost/api/";
const liveUrl = "https://www.wtc-web.com/api/"; // PUT YOUR DOMAIN NAME HERE watch out for the www
var url;

if(location.hostname == "localhost"){
    url = devUrl;
}else{
    url = liveUrl;
    // we want to make sure we are using https on the live server
    // I got this code from here: https://stackoverflow.com/questions/4723213/detect-http-or-https-then-force-https-in-javascript
    if (location.protocol !== 'https:') {
        location.replace(`https:${location.href.substring(location.protocol.length)}`);
    }
}

const ax = axios.create({
    baseURL: url
});
// We'll get the session id (from the x-id response header) when a user logs in (see the login() method below), 
// and send it in every request so that the server can keep the session going 
var sessionId = "";

// You can 'intercept' all requests made by ax, and add your own headers to the request
// Here we're adding the x-id header so that the server can keep the session going
ax.interceptors.request.use(
    function(request) {
        request.headers['x-id'] = sessionId;
        return request;
    }
)

const UserDataAccess = {
    getAllUsers(){
        return ax.get("users/")
    },
    insertUser(user){
        return ax.post("users/", user).catch((error) => errorHandler("Error Updating User:" + error));
    },
    updateUser(user){
        return ax.put("users/" + user.id, user).catch((error) => errorHandler("Error Inserting User:" + error));
    },
    login(email, password){
        
        return ax.post("login/", {email,password}).then(resp => {
            
            // When you log in on the server, it will send the x-id header, which is the session id
            if(resp.headers['x-id']){
                // we'll store the session id so that we can send it in every subsequent request
                sessionId = resp.headers['x-id'];
            }
            
            // make sure to return a Promise so that your code in the Login.vue
            // can do it's then()
            return new Promise((resolve, reject) => {
                resolve(resp);
            });
        });
    },
    getUserById(id){
        return ax.get("users/" + id).catch((error) => errorHandler("Error getting user by id:" + error));
    },
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