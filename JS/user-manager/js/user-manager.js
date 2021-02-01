window.addEventListener("load", function(){
	
	// Here is the data that we'll be working with:
	var users = [
		{id:1, firstName:"Jane", lastName:"Doe", email:"jdoe@acme.com", password:"foo", birthdate:"02/03/2001"},
		{id:2, firstName:"Tony", lastName:"Thompsom", email:"tony@acme.com", password:"bar", birthdate:"7/3/2000"},
		{id:3, firstName:"Jesse", lastName:"Jones", email:"jesse@acme.com", password:"bang", birthdate:"2/3/2002"}
	];


	///////////////////////////////////////////
	// PART 1 - Data binding users to a list
	///////////////////////////////////////////
	var list = document.querySelector("#lsUserList");
	var form = document.getElementById(`frmUserDetails`);
	var txtId = form.querySelector("#txtId");
	var txtFirstName = form.querySelector("#txtFirstName");
	var txtLastName = form.querySelector("#txtLastName");
	var txtEmail = form.querySelector("#txtEmail");
	var txtPassword = form.querySelector("#txtPassword");
	var txtBirthDate = form.querySelector("#txtBirthDate");
	var btnAddUser = document.querySelector("#btnAddUser");
	var btnDeleteUser = document.querySelector("#btnDelete");
	
	form.addEventListener("submit", evt => {
		evt.preventDefault();

	if(validate()){
		if(txtId.value > 0){
			let user = getUserById(txtId.value);
			updateUser(user);
			displayUserList(users);
			}
		}
		else{
			var newUser = {};
			updateUser(newUser);
			newUser.id = getMaxId(users) + 1;
			users.push(newUser);
			displayUserList(users);

		}
	});

	function displayUserList(userArray){
		list.innerHTML = "";
		for (const key in userArray) {
			if (userArray.hasOwnProperty(key)) {
				const element = userArray[key];
				let li = document.createElement("li");
				li.innerHTML = element.firstName;
				list.appendChild(li);
				li.setAttribute("userId", element.id);
			}
		}
	}
	displayUserList(users);

	function displayUser(u){
		txtId.value = u.id;
		txtFirstName.value = u.firstName;
		txtLastName.value = u.lastName;
		txtEmail.value = u.email;
		txtPassword.value = u.password;
		txtBirthDate.value = u.birthdate;

	}

	displayUser(users[1]);

	///////////////////////////////////////////
	// PART 2
	// Add validation code
	///////////////////////////////////////////
	function validate(){
		let txtPattern = /\D+/
		let txtPatternPassword = /\w+/
		let txtPatternEmail = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/; //stackoverflow ex
		if(txtFirstName == "" || txtPattern.test(txtFirstName)){
			return false;
		}
		else if(txtLastName == "" || txtPattern.test(txtLastName)){
			return false;
		}
		else if(txtPassword == "" || txtPatternPassword.test(txtPassword)){
			return false;
		}
		else if(txtBirthDate == "" || txtPatternEmail.test(txtEmail)){
			return false;
		}
		else {
			return true;
		}
	}

	

	
	///////////////////////////////////////////
	// PART 3 - Editing Users
	///////////////////////////////////////////

	function getUserById(userId){
		for(var x = 0; x < users.length; x++){
			if(userId == users[x].id){
				return users[x];
			}
		}
	}

	list.addEventListener("click", evt => {
		let userId = evt.target.getAttribute("userId");
		let selectedUser = getUserById(userId);
		if(selectedUser){
			displayUser(selectedUser);
		}
	});

	function updateUser(user){
		user.firstName = txtFirstName.value;
		user.lastName = txtLastName.value;
		user.email = txtEmail.value;
		user.password = txtPassword.value;
		user.birthdate = txtBirthDate.value;

		clearForm();
	}

	function clearForm(){
		txtId.value = "";
		txtFirstName.value = "";
		txtLastName.value = "";
		txtEmail.value = "";
		txtPassword.value = "";
		txtBirthDate.value = "";
	}


	///////////////////////////////////////////
	// PART 4 - Adding Users
	///////////////////////////////////////////
	btnAddUser.addEventListener("click", () => {
		clearForm();
		txtFirstName.focus();
		//txtId.value = getMaxId(users);
	});
	
	function getMaxId(userArray){
		let maxId = 0;
		for(let x = 0; x < userArray.length; x++){
			if(maxId < userArray[x].id){
				maxId = userArray[x].id;
			}
		}
		return maxId;
	}
		

	///////////////////////////////////////////
	// PART 5 - Deleting Users
	///////////////////////////////////////////



});