class UserList{

    //instance
    container;
    users;
    ul;

    selectedListeners = [];
    
    // constructor
    constructor({containerSelector, users }){
        this.container = document.querySelector(containerSelector);
        this.users = users;
        this.render();
    }

    //Methods
    render(){
        
    }
}