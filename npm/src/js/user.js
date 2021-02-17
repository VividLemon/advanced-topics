class User{

	// NOTE: We are using ES 2019 private instance variables (they start with #)
	// ES 2019 is not currently supported by all browsers, so this app may only work in Chrome
	// But you could use Babel to transpile the code to ES5, and then it should work in all browsers

	// INSTANCE VARIABLES
	#id; 
	#firstName; 
	#lastName; 
	#email; 
	#password; 
	#birthdate;

	// CONSTRUCTOR
	constructor({id, firstName, lastName, email, password, birthdate}){
		this.#id = id || 0; 
		this.#firstName = firstName; 
		this.#lastName = lastName; 
		this.#email = email; 
		this.#password = password; 
		this.#birthdate = birthdate;
	}

	// SETTERS/GETTERS (aka 'properties' in C#)

	// METHODS

}
	