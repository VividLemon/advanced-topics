<?php
session_start();

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == "yes"){
	echo(" USER ID: " . $_SESSION['user_id']);
	echo(" FIRST NAME: " . $_SESSION['user_first_name']);
	echo(" ROLE ID: " . $_SESSION['user_role_id']);
}else{
	echo("Not Logged In");
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Login Controller Tests</title>
	<!-- Import Axios -->
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script type="text/javascript">
	

	window.addEventListener("load", () => {


		// Create an instance of axios and set the base URL
		const ax = axios.create({
		  baseURL: 'http://localhost/api/'
		});


		// notice that we are listening for submit events on the form
		// and then preventing the default behavior
		document.getElementById("frmLogin").addEventListener("submit", (evt) => {

			evt.preventDefault();

			const email = document.getElementById("txtEmail").value;
			const password = document.getElementById("txtPassword").value;

			ax.post("login/", {email, password})
				.then(response => {
					alert(response.status);
					// refresh the page...
					location.href = location.href;
				})
				.catch(error => console.log(error));

		});

		document.getElementById("btnLogout").addEventListener("click", () => {
			ax.get("logout/")
				.then(response => {
					alert(response.status);
					// refresh the page...
					location.href = location.href;
				})
				.catch(error => console.log(error));
		});

	});

		
	</script>
</head>
<body>
	<h2>Login</h2>
	<form id="frmLogin">
		<label>Email</label>
		<br>
		<input type="text" id="txtEmail">
		<br>
		<label>Password</label>
		<br>
		<input type="password" id="txtPassword">
		<br>
		<input type="submit" value="Log In">
	</form>
	<p>Make sure the user is 'active' (they can't log in unless they are 'active').</p>
	<input type="button" value="Log Out" id="btnLogout">
</body>
</html>