let acceptButton = document.querySelector("#accept_rules");
let fullName = document.querySelector("#reg_fullname");
let username = document.querySelector("#reg_username");
let email = document.querySelector("#reg_email");
let password = document.querySelector('#reg_password');
let registerButton = document.querySelector('#reg_btn');

checkAll

acceptButton.addEventListener("click", () => {
	checkAll();
})

fullName.addEventListener("change", (e) => {
    if (isValidFullName(e.target.value)) {
		fullName.style.borderColor = "green";
	} else {
		fullName.style.borderColor = "red";
    }
	checkAll();
})

username.addEventListener("change", (e) => {
	if (isValidUsername(e.target.value)) {
		username.style.borderColor = "green";
	} else {
		username.style.borderColor = "red";
	}
	checkAll();
})

email.addEventListener("change", (e) => {
	if (isValidEmail(e.target.value)) {
		email.style.borderColor = "green";
	} else {
		email.style.borderColor = "red";
	}
	checkAll();
})
password.addEventListener("change", (e) => {
	if (isStrongPassword(e.target.value)) {
		password.style.borderColor = "green";
		
	} else {
		password.style.borderColor = "red";
	}
	checkAll();
})

function checkAll() {
	if (isAcceptRules() && isValidEmail(email.value) && isValidFullName(fullName.value) && isStrongPassword(password.value) ) {
		registerButton.disabled  = false;
		registerButton.classList.remove("btn-disabled");
	} else {
		registerButton.disabled  = true;
		registerButton.classList.add("btn-disabled");
	}
}

function isAcceptRules() {
	return acceptButton.checked;
}

function isValidFullName(fullName) {
	console.log(fullName);
	var pattern = /^[A-Za-zÀ-ỹ\s]+$/;

    // Test the full name against the pattern
    return pattern.test(fullName);
}

function isValidEmail(email) {
	
	var emailPattern = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

    // Test the email against the pattern
    return emailPattern.test(email);
}

function isStrongPassword(password) {
    
    var hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\\-]/;
    var hasNumber = /[0-9]/;

    // Check if the password contains at least one special character and one number
    return hasSpecialChar.test(password) && hasNumber.test(password);
}

function isValidUsername(username) {
    // Define a regular expression pattern for a valid username
    var pattern = /^[a-zA-Z0-9_]+$/;

    // Test the username against the pattern
    return pattern.test(username);
}
