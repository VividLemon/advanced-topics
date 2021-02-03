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
        this.container.innerHTML = "";
        if (this.users && this.users.length > 0) {
            this.ul = document.createElement("ul");
            this.users.forEach(user => {
                var li = document.createElement("li");
                li.innerHTML = `${user.firstName} ${user.lastName}`;
                li.setAttribute("userId", user.id);
                this.ul.appendChild(li);
            });
            this.container.appendChild(this.ul);
            this.ul.addEventListener("click", evt => {
                var selectedUserId = evt.target.getAttribute("userId");
                //alert(selectedUserId);
                if (selectedUserId) {
                    // we should create a triggerEvent() method to do this
                    this.selectedListeners.forEach(listener => {
                        listener(selectedUserId);
                    });
                }
            });
        }

    }
}