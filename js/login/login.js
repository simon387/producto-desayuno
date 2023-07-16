const remembermeKey = "rememberme";
const remembermeEmailKey = "remembermeEmail";
const remembermePasslKey = "remembermePass";
const checkboxId = "customCheck";
const email = "email";
const password = "password";

$(document).ready(function () {
	const checkbox = document.getElementById(checkboxId);
	if (localStorage.getItem(remembermeKey)) {
		checkbox.checked = true;
		document.getElementById(email).value = localStorage.getItem(remembermeEmailKey);
		document.getElementById(password).value = localStorage.getItem(remembermePasslKey);
	} else {
		checkbox.checked = false;
	}
});

function remembermeClick() {
	const checkbox = document.getElementById(checkboxId);
	if (checkbox.checked) {
		localStorage.setItem(remembermeKey, "true");
		localStorage.setItem(remembermeEmailKey, document.getElementById(email).value);
		localStorage.setItem(remembermePasslKey, document.getElementById(password).value);
	} else {
		localStorage.removeItem(remembermeKey);
		localStorage.removeItem(remembermeEmailKey);
		localStorage.removeItem(remembermePasslKey);
	}
}

function processForm() {
	remembermeClick();
}

const form = document.getElementById('login-form');
if (form.attachEvent) {
	form.attachEvent("submit", processForm);
} else {
	form.addEventListener("submit", processForm);
}
