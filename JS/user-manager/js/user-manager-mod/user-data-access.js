class UserDataAccess{
    
    // instance
    users = [];

    // constructor
    constructor(users){
        this.users = users;
    }

    //methods
    getAllUsers(){
        return this.users;
    }

    getUserById(userId){
        return this.users.find(element => element.id == userId);
        /*
        for(let x = 0; x < this.users.length; x++){
            if(this.users[x].id == userId) return this.users[x];
        }
        */
    }

    getMaxId(){
        // let maxId = 0;
        // this.users.forEach(element => {
        //     if(element.id > maxId){
        //         maxId = element.id;
        //     }
        // });
        // return maxId;
        //let sorted = this.users.sort((a,b) => b.id - a.id);
        //return sorted[0];
        return Math.max(...this.users.map(user => user.id));
    }

}